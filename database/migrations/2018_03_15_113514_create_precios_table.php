<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compra_id');
            $table->integer('producto_id');
            $table->decimal('base1',20,2);
            $table->decimal('base2',20,2);
            $table->decimal('base3',20,2);
            $table->timestamps();
            $table->softDeletes();
            $table->index('compra_id','producto_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios');
    }
}
