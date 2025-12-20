<?php

namespace App\Imports;

use App\Models\InvestorEntries;
use App\Models\Investors;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class InvestorAndEntriesImport implements
    OnEachRow,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    WithBatchInserts
{
    use Importable, SkipsFailures;

    /**
     * @param Row $row
     * @return void
     */
    public function onRow(Row $row): void
    {
        $rowData = $row->toArray();

        // Upsert investor by id
        $investor = Investors::updateOrCreate(
            ['id' => $rowData['investor_id']],
            ['name' => $rowData['name'], 'age' => $rowData['age']]
        );

        // Create investor entries
        InvestorEntries::create([
            'investor_id'       => $investor->id,
            'investment_amount' => $rowData['investment_amount'],
            'investment_date'   => Carbon::parse($rowData['investment_date'])->toDateString(),
        ]);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            '*.investor_id'       => ['required', 'integer'],
            '*.name'              => ['required', 'string'],
            '*.age'               => ['required', 'integer'],
            '*.investment_amount' => ['required', 'numeric'],
            '*.investment_date'   => ['required', 'date'],
        ];
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}
