<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PortfolioAPIControllerExt;

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

Route::get('portfolios/{id}/as_of/{as_of}', 'App\Http\Controllers\APIv1\PortfolioAPIControllerExt@showAsOf');
Route::post('portfolios/{code}/assets_update', 'App\Http\Controllers\APIv1\PortfolioAPIControllerExt@assetsUpdate');

Route::get('funds/{id}/as_of/{as_of}', 'App\Http\Controllers\APIv1\FundAPIControllerExt@showAsOf');
Route::get('funds/{id}/performance_as_of/{as_of}', 'App\Http\Controllers\APIv1\FundAPIControllerExt@showPerformanceAsOf');
Route::get('funds/{id}/account_balances_as_of/{as_of}', 'App\Http\Controllers\APIv1\FundAPIControllerExt@showAccountBalancesAsOf');
Route::get('funds/{id}/report_as_of/{as_of}', 'App\Http\Controllers\APIv1\FundAPIControllerExt@showReportAsOf');

Route::get('accounts/{id}/as_of/{as_of}', 'App\Http\Controllers\APIv1\AccountAPIControllerExt@showAsOf');
Route::get('accounts/{id}/transactions_as_of/{as_of}', 'App\Http\Controllers\APIv1\AccountAPIControllerExt@showTransactionsAsOf');
Route::get('accounts/{id}/performance_as_of/{as_of}', 'App\Http\Controllers\APIv1\AccountAPIControllerExt@showPerformanceAsOf');
Route::get('accounts/{id}/report_as_of/{as_of}', 'App\Http\Controllers\APIv1\AccountAPIControllerExt@showReportAsOf');

Route::resource('funds', App\Http\Controllers\API\FundAPIController::class);
Route::resource('accounts', App\Http\Controllers\API\AccountAPIController::class);
Route::resource('portfolios', App\Http\Controllers\API\PortfolioAPIController::class);
Route::resource('transactions', App\Http\Controllers\API\TransactionAPIController::class);

Route::resource('asset_prices', App\Http\Controllers\API\AssetPriceAPIControllerExt::class);
Route::resource('assets', App\Http\Controllers\API\AssetAPIControllerExt::class);

Route::resource('account_balances', App\Http\Controllers\API\AccountBalanceAPIController::class);
Route::resource('account_matching_rules', App\Http\Controllers\API\AccountMatchingRuleAPIController::class);
Route::resource('matching_rules', App\Http\Controllers\API\MatchingRuleAPIController::class);
Route::resource('portfolio_assets', App\Http\Controllers\API\PortfolioAssetAPIController::class);

// Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
Route::resource('asset_change_logs', App\Http\Controllers\API\AssetChangeLogAPIController::class);
Route::resource('transaction_matchings', App\Http\Controllers\API\TransactionMatchingAPIController::class);
