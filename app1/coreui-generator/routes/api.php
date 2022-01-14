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


Route::resource('funds', App\Http\Controllers\API\FundAPIControllerExt::class);
Route::resource('account_balances', App\Http\Controllers\API\AccountBalanceAPIController::class);
Route::resource('account_matching_rules', App\Http\Controllers\API\AccountMatchingRuleAPIController::class);
Route::resource('account_trading_rules', App\Http\Controllers\API\AccountTradingRuleAPIController::class);
Route::resource('accounts', App\Http\Controllers\API\AccountAPIControllerExt::class);
Route::resource('asset_prices', App\Http\Controllers\API\AssetPriceAPIControllerExt::class);
Route::resource('assets', App\Http\Controllers\API\AssetAPIControllerExt::class);
Route::resource('matching_rules', App\Http\Controllers\API\MatchingRuleAPIController::class);
Route::resource('portfolio_assets', App\Http\Controllers\API\PortfolioAssetAPIController::class);
Route::resource('portfolios', App\Http\Controllers\API\PortfolioAPIControllerExt::class);
Route::resource('trading_rules', App\Http\Controllers\API\TradingRuleAPIController::class);
Route::resource('transactions', App\Http\Controllers\API\TransactionAPIControllerExt::class);
// Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
Route::resource('asset_change_logs', App\Http\Controllers\API\AssetChangeLogAPIController::class);
