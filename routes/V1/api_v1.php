<?php

use App\Http\Controllers\Api\V1\InvestorsController;
use Illuminate\Support\Facades\Route;


Route::post('import', [InvestorsController::class, 'importRecord']);
