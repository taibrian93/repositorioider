<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('population_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idDistrict');
            $table->foreign('idDistrict')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('descripcion');
            $table->char('codigo',4);
            $table->char('codigoCentroPoblado',10)->unique();
            $table->timestamps();
            $table->boolean('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('population_centers');
    }
}
