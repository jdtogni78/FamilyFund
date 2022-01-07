<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountBalancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_balances', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type', 3)->nullable();
            $table->decimal('shares', 19, 4);
            // $table->integer('account_id', false);
            $table->foreignId('account_id')->nullable()->index();
            $table->foreignId('tran_id')->index();
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
        Schema::dropIfExists('account_balances');
    }
}
