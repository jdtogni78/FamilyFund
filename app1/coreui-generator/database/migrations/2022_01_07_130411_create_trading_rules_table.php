<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingRulesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trading_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30);
            $table->decimal('max_sale_increase_pcnt', 5, 2)->nullable();
            $table->decimal('min_fund_performance_pcnt', 5, 2)->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trading_rules');
    }
}
