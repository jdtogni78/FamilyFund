<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('funds', fundsAPIController::class);
Route::resource('account_balances', AccountBalancesAPIController::class);
Route::resource('account_matching_rules', AccountMatchingRulesAPIController::class);
Route::resource('account_trading_rules', AccountTradingRulesAPIController::class);
Route::resource('accounts', AccountsAPIController::class);
Route::resource('asset_prices', AssetPricesAPIController::class);
Route::resource('assets', AssetsAPIController::class);
Route::resource('matching_rules', MatchingRulesAPIController::class);
Route::resource('portfolio_assets', PortfolioAssetsAPIController::class);
Route::resource('portfolios', PortfoliosAPIController::class);
Route::resource('trading_rules', TradingRulesAPIController::class);
Route::resource('transactions', TransactionsAPIController::class);
Route::resource('users', UsersAPIController::class);
