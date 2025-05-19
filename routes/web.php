<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EncodingController;
use App\Http\Controllers\RomanNumeralController;
use App\Http\Controllers\ShortestPathController;
use App\Http\Controllers\SinCurveController;
use App\Http\Controllers\MarblePredictionController;
use App\Http\Controllers\LiftController; // Import LiftController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

// --- Problem Index Page (Simple Navigation) ---
Route::get('/problems', function () {
    return view('solutions.index');
})->name('problems.index');

// --- BASIC LEVEL ---
Route::get('/bank/interest-loop', [BankController::class, 'showInterestCalculator'])->name('bank.interest.show');
Route::post('/bank/interest-loop', [BankController::class, 'calculateInterest'])->name('bank.interest.calculate');
Route::get('/bank/interest-no-loop', [BankController::class, 'showInterestCalculatorNoLoop'])->name('bank.interest-no-loop.show');
Route::post('/bank/interest-no-loop', [BankController::class, 'calculateInterestNoLoop'])->name('bank.interest-no-loop.calculate');
Route::get('/discount/calculator', [DiscountController::class, 'showDiscountCalculator'])->name('discount.calculator.show');
Route::post('/discount/calculator', [DiscountController::class, 'calculateDiscount'])->name('discount.calculator.calculate');
Route::get('/encoding/encoder', [EncodingController::class, 'showEncoder'])->name('encoding.show');
Route::post('/encoding/encoder', [EncodingController::class, 'processEncode'])->name('encoding.process');

// --- INTERMEDIATE LEVEL ---
Route::get('/roman/converter', [RomanNumeralController::class, 'showConverter'])->name('roman.converter.show');
Route::post('/roman/converter', [RomanNumeralController::class, 'convertToArabic'])->name('roman.converter.process');
Route::get('/shortest-path', [ShortestPathController::class, 'showPathForm'])->name('shortestpath.form.show');
Route::match(['get', 'post'], '/shortest-path/triangle-input', [ShortestPathController::class, 'showTriangleInputForm'])->name('shortestpath.triangle.show_form');
Route::post('/shortest-path/calculate', [ShortestPathController::class, 'calculateShortestPath'])->name('shortestpath.calculate');
Route::get('/sincurve/calculator', [SinCurveController::class, 'showAreaCalculator'])->name('sincurve.calculator.show');
Route::post('/sincurve/calculator', [SinCurveController::class, 'calculateArea'])->name('sincurve.calculator.process');

// --- ADVANCED LEVEL ---
Route::match(['get', 'post'], '/marble-prediction', [MarblePredictionController::class, 'predictionInterface'])->name('marble.prediction.show');
Route::post('/marble-prediction/reset', [MarblePredictionController::class, 'predictionInterface'])->name('marble.prediction.reset');

// Problem 8: Lift Control
Route::get('/lift-control', [LiftController::class, 'showControlPanel'])->name('lift.control.show');
Route::post('/lift-control', [LiftController::class, 'processAssignments'])->name('lift.control.process');
