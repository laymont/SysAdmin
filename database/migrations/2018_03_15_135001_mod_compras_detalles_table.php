<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModComprasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('compras_detalles', function (Blueprint $table) {
        $table->date('vence')->nullable()->after('producto_id');
        $table->string('lote')->nullable()->after('producto_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('compras_detalles', function (Blueprint $table) {
        $table->dropColumn('vence');
        $table->dropColumn('lote');
      });
    }
  }

