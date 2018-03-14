<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('clientes', function (Blueprint $table) {
        $table->tinyInteger('isrl')->nullable()->after('nombre');
        $table->enum('retiene', [0,1,2])->after('nombre');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('clientes', function (Blueprint $table) {
        $table->dropColumn('isrl');
        $table->dropColumn('retiene');
      });
    }
  }
