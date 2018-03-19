<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('proveedor_id');
            $table->integer('documento');
            $table->decimal('subtotal',20,2);
            $table->decimal('iva',20,2);
            $table->decimal('total',20,2);
            $table->timestamps();
            $table->softDeletes();
            $table->index('proveedor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
