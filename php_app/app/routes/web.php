<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundController;

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

Route::resource('users', 'App\Http\Controllers\UserController');

Route::resource('assets', 'App\Http\Controllers\AssetController');
Route::resource('asset_prices', 'App\Http\Controllers\AssetPriceController');
Route::resource('portfolios', 'App\Http\Controllers\PortfolioController');
Route::resource('portfolio_assets', 'App\Http\Controllers\PortfolioAssetController');

Route::resource('account_balances', 'App\Http\Controllers\AccountBalanceController');
Route::resource('account_holders', 'App\Http\Controllers\AccountHolderController');
Route::resource('account_matching_rules', 'App\Http\Controllers\AccountMatchingRuleController');
Route::resource('account_trading_rules', 'App\Http\Controllers\AccountTradingRuleController');
Route::resource('accounts', 'App\Http\Controllers\AccountController');
Route::resource('funds', 'App\Http\Controllers\FundController');
Route::resource('matching_rules', 'App\Http\Controllers\MatchingRuleController');
Route::resource('trading_rules', 'App\Http\Controllers\TradingRuleController');
Route::resource('transactions', 'App\Http\Controllers\TransactionController');
