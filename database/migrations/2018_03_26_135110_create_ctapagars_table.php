<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtapagarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ctapagars', function (Blueprint $table) {
        $table->increments('id');
        $table->date('fecha');
        $table->string('referencia',120);
        $table->enum('tipo', ['Proveedores','Servicios','Servidores','Otros']);
        $table->string('observacion',200)->nullable();
        $table->decimal('monto',20,2);
        $table->enum('abono', ['No','Si']);
        $table->date('fecha_abono')->nullable();
        $table->integer('banco_id')->default(0);
        $table->enum('movimiento',['Deposito','Cheque','Transferencia']);
        $table->enum('pagada', ['No','Si']);
        $table->timestamps();
        $table->softDeletes();
        $table->unique(['referencia','deleted_at']);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('ctapagars');
    }
  }
