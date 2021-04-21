<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTypeDocument');
            $table->foreign('idTypeDocument')->references('id')->on('type_documents')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idTypeFormat')->nullable();
            $table->foreign('idTypeFormat')->references('id')->on('type_formats')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idLanguage');
            $table->foreign('idLanguage')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idDepartment');
            $table->foreign('idDepartment')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idProvince');
            $table->foreign('idProvince')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idDistrict');
            $table->foreign('idDistrict')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idPopulationCenter');
            $table->foreign('idPopulationCenter')->references('id')->on('population_centers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('idNode');
            $table->foreign('idNode')->references('id')->on('nodes')->onDelete('cascade')->onUpdate('cascade');

            $table->string('titulo');
            $table->string('descripcion');
            $table->text('enlace')->nullable();
            $table->text('mimeType')->nullable();
            $table->string('extensionArchivo', 20)->nullable();
            $table->bigInteger('sizeFile')->nullable();
            $table->char('codigo')->unique()->nullable();
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
        Schema::dropIfExists('files');
    }
}
