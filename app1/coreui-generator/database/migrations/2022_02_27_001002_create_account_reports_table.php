<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundReportsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_reports', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->foreignId('fund_id')->constrained();
            $table->date('start_dt')->default(DB::raw('curdate()'));
            $table->date('end_dt')->default('9999-12-31');
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
        Schema::drop('transaction_matchings');
    }
}
