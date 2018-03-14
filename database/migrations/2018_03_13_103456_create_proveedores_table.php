<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rif',12);
            $table->string('nombre',160);
            $table->enum('retiene', [0,1,2])->default(0);
            $table->tinyInteger('isrl')->nullable();
            $table->text('direccion');
            $table->string('telefono',200);
            $table->string('email');
            $table->enum('credito',['Si','No'])->default('No');
            $table->smallInteger('dias')->default(0);
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
        Schema::dropIfExists('proveedores');
    }
}
