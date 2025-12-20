<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestorCsvRequest;
use App\Imports\InvestorAndEntriesImport;
use App\Models\InvestorEntries;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class InvestorEntriesController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAverageInvestmentAmount(): JsonResponse
    {
        return response()->json([
            'averageInvestmentAmount' => round(InvestorEntries::avg('investment_amount'), 2)
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getTotalInvestments(): JsonResponse
    {
        return response()->json([
            'totalInvestments' => InvestorEntries::count()
        ]);
    }
}
