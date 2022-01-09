<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\AssetPriceHistoryController;

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


Route::resource('funds', App\Http\Controllers\API\fundsAPIController::class);
Route::resource('account_balances', App\Http\Controllers\API\AccountBalancesAPIController::class);
Route::resource('account_matching_rules', App\Http\Controllers\API\AccountMatchingRulesAPIController::class);
Route::resource('account_trading_rules', App\Http\Controllers\API\AccountTradingRulesAPIController::class);
Route::resource('accounts', App\Http\Controllers\API\AccountsAPIController::class);
Route::resource('asset_prices', App\Http\Controllers\API\AssetPricesAPIControllerExt::class);
Route::resource('assets', App\Http\Controllers\API\AssetsAPIControllerExt::class);
Route::resource('matching_rules', App\Http\Controllers\API\MatchingRulesAPIController::class);
Route::resource('portfolio_assets', App\Http\Controllers\API\PortfolioAssetsAPIController::class);
Route::resource('portfolios', App\Http\Controllers\API\PortfoliosAPIControllerExt::class);
Route::resource('trading_rules', App\Http\Controllers\API\TradingRulesAPIController::class);
Route::resource('transactions', App\Http\Controllers\API\TransactionsAPIController::class);
Route::resource('users', App\Http\Controllers\API\UsersAPIController::class);
