<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departamento_id');
            $table->string('nombre');
            $table->integer('marca_id');
            $table->string('presentacion');
            $table->string('descripcion')->nullable();
            $table->tinyInteger('exento')->default(0);
            $table->tinyInteger('servicio')->default(0);
            $table->integer('min');
            $table->integer('max');
            $table->timestamps();
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
        Schema::dropIfExists('productos');
    }
}
