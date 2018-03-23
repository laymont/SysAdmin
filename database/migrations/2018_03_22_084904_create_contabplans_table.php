<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContabplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contabplans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cuenta',12);
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->index('cuenta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contabplans');
    }
}
