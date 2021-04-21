<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_extensions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTypeFormat');
            $table->foreign('idTypeFormat')->references('id')->on('type_formats')->onDelete('cascade')->onUpdate('cascade');
            $table->char('descripcion', 10)->unique();;
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
        Schema::dropIfExists('type_extensions');
    }
}
