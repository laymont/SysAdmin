<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compra_id');
            $table->integer('producto_id');
            $table->string('lote')->nullable();
            $table->date('vence')->nullable();
            $table->integer('cantidad');
            $table->decimal('costo',20,2);
            $table->decimal('base1',20,2);
            $table->decimal('base2',20,2);
            $table->decimal('base3',20,2);
            $table->tinyInteger('ubicacion')->nullable();
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
        Schema::dropIfExists('inventarios');
    }
}
