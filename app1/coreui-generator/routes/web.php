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


Route::resource('funds', App\Http\Controllers\fundsController::class);


Route::resource('accountBalances', App\Http\Controllers\AccountBalancesController::class);


Route::resource('accountBalances', App\Http\Controllers\AccountBalancesController::class);


Route::resource('accountBalances', App\Http\Controllers\AccountBalancesController::class);


Route::resource('accountMatchingRules', App\Http\Controllers\AccountMatchingRulesController::class);


Route::resource('accountTradingRules', App\Http\Controllers\AccountTradingRulesController::class);


Route::resource('accounts', App\Http\Controllers\AccountsController::class);


Route::resource('assetPrices', App\Http\Controllers\AssetPricesController::class);


Route::resource('assets', App\Http\Controllers\AssetsController::class);


Route::resource('matchingRules', App\Http\Controllers\MatchingRulesController::class);


Route::resource('portfolioAssets', App\Http\Controllers\PortfolioAssetsController::class);


Route::resource('portfolios', App\Http\Controllers\PortfoliosController::class);


Route::resource('tradingRules', App\Http\Controllers\TradingRulesController::class);


Route::resource('transactions', App\Http\Controllers\TransactionsController::class);


Route::resource('users', App\Http\Controllers\UsersController::class);
