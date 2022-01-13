<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->string('name', 128);
            $table->string('type', 3);
            $table->string('source_feed', 50);
            $table->string('feed_id', 128);
            // $table->decimal('last_price', 19, 2);
            // $table->date('last_price_date');
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
        Schema::dropIfExists('assets');
    }
}
