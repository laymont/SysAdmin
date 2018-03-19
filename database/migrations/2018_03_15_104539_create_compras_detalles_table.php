<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compra_id');
            $table->integer('producto_id');
            $table->integer('cantidad');
            $table->decimal('costo',20,2);
            $table->tinyInteger('inventario')->default(0);
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
        Schema::dropIfExists('compras_detalles');
    }
}
