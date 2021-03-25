<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderredCanvassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderred_canvasses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('canvass_id')->constrained(); // todo: make migation
            $table->foreignId('glass_handle_id')->constrained(); // todo: make migration
            $table->float('width');
            $table->float('height');
            $table->float('inner_margin_vertical');
            $table->float('inner_margin_horizontal');
            $table->float('outer_margin_vertical');
            $table->float('outer_margin_horizontal');
            $table->integer('rabbet_id'); // used integer so I won't have to create the actual table
            $table->integer('sill_id'); // used integer so I won't have to create the actual table
            $table->integer('lacquer_id'); // used integer so I won't have to create the actual table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canvasses');
    }
}
