<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderredCanvasCommonOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderred_canvas_common_option', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderred_canvasses_id')->constrained();
            $table->foreignId('common_options_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_canvas_common_option');
    }
}
