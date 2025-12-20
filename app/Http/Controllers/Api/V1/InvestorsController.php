<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestorCsvRequest;
use App\Imports\InvestorAndEntriesImport;
use App\Models\InvestorEntries;
use App\Models\Investors;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class InvestorsController extends Controller
{
    /**
     * @param InvestorCsvRequest $request
     * @return JsonResponse
     */
    public function importRecord(InvestorCsvRequest $request): JsonResponse
    {
        try {
            $csvFile = $request->file('csvFile');
            $import = new InvestorAndEntriesImport();
            $import->import($csvFile);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }

        // Log all rows that failed to import
        foreach ($import->failures() as $failure) {
            Log::channel('csv_import_log_file')
            ->error('Row {row} failed on attribute {attribute} with error: {error}',
                [
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'error' => $failure->errors()
                ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Operation successful.'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAverageAge(): JsonResponse
    {
        return response()->json([
            'averageAge' => round(Investors::avg('age'))
        ]);
    }

    public function getInvestorsAndAmounts(): JsonResponse
    {
        $investors = Investors::select(['id', 'name', 'age'])
            ->withSum('investorEntries as investment_amount', 'investment_amount')
            ->orderBy('id')
            ->cursorPaginate(15);
        return response()->json($investors);
    }
}
