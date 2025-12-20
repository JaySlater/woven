<?php

use App\Http\Controllers\Api\V1\InvestorEntriesController;
use App\Http\Controllers\Api\V1\InvestorsController;
use Illuminate\Support\Facades\Route;


Route::post('import', [InvestorsController::class, 'importRecord'])->name('investors.import');
Route::get('average-age', [InvestorsController::class, 'getAverageAge'])->name('investors.getAverageAge');
Route::get('average-investment-amount', [InvestorEntriesController::class, 'getAverageInvestmentAmount'])->name('investors.getAverageInvestmentAmount');
Route::get('total-investments', [InvestorEntriesController::class, 'getTotalInvestments'])->name('investors.getTotalInvestments');
Route::get('all-investor-amounts', [InvestorsController::class, 'getInvestorsAndAmounts'])->name('investors.getInvestorsAndAmounts');
