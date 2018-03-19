<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('compras', function (Blueprint $table) {
        $table->tinyInteger('nula')->nullable()->after('total');
        $table->tinyInteger('pago')->after('total');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('compras', function (Blueprint $table) {
        $table->dropColumn('pago');
      });
    }
  }
