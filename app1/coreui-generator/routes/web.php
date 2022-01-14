<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('funds', App\Http\Controllers\FundController::class);


Route::resource('accountBalances', App\Http\Controllers\AccountBalanceController::class);


Route::resource('accountMatchingRules', App\Http\Controllers\AccountMatchingRuleController::class);


Route::resource('accountTradingRules', App\Http\Controllers\AccountTradingRuleController::class);


Route::resource('accounts', App\Http\Controllers\AccountController::class);


Route::resource('assetPrices', App\Http\Controllers\AssetPriceController::class);


Route::resource('assets', App\Http\Controllers\AssetController::class);


Route::resource('matchingRules', App\Http\Controllers\MatchingRuleController::class);


Route::resource('portfolioAssets', App\Http\Controllers\PortfolioAssetController::class);


Route::resource('portfolios', App\Http\Controllers\PortfolioController::class);


Route::resource('tradingRules', App\Http\Controllers\TradingRuleController::class);


Route::resource('transactions', App\Http\Controllers\TransactionController::class);


// Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('assetChangeLogs', App\Http\Controllers\AssetChangeLogController::class);