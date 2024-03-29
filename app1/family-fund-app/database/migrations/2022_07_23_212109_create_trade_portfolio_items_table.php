

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradePortfolioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_portfolio_items', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->foreignId('trade_portfolio_id')->constrained();
            $table->string('symbol', 50);
            $table->string('type', 50);
            $table->decimal('target_share', 5, 3)->default('0.10');
            $table->decimal('deviation_trigger', 8, 5)->default('0.00500');
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
        Schema::dropIfExists('trade_portfolio_items');
    }
}

