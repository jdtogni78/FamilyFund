<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTradePortfolioFund extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_portfolios', function (Blueprint $table) {
//            $table->dropConstrainedForeignId('fund_id');
            $table->foreignId('fund_id')->after('account_name')->nullable()->constrained();
        });
        DB::statement("UPDATE trade_portfolios SET fund_id = (SELECT id FROM funds LIMIT 1)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_portfolios', function (Blueprint $table) {
            $table->dropConstrainedForeignId('fund_id');
        });
    }
}
