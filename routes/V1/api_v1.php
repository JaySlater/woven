<?php

use App\Http\Controllers\Api\V1\InvestorEntriesController;
use App\Http\Controllers\Api\V1\InvestorsController;
use Illuminate\Support\Facades\Route;


Route::post('import', [InvestorsController::class, 'importRecord']);
Route::get('average-age', [InvestorsController::class, 'getAverageAge']);
Route::get('average-investment-amount', [InvestorEntriesController::class, 'getAverageInvestmentAmount']);
Route::get('total-investments', [InvestorEntriesController::class, 'getTotalInvestments']);
