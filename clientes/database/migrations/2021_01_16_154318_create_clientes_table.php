<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->tinyIncrements('idCliente');
            $table->string('cliNombre', 50);
            $table->string('cliApellido', 50);
            $table->string('cliEmail', 70);
            //$table->foreignId('idPais')
            //                ->constrained('paises');
            $table->tinyInteger('idPais')
                          ->references('idPais')
                            ->on('paises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
