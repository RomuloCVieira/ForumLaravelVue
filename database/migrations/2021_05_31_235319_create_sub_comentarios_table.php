<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idcomentario');
            $table->unsignedBigInteger('idusuario');
            $table->text('comentario', 140);
            $table->foreign('idcomentario')->references('id')->on('comentarios');
            $table->foreign('idusuario')->references('id')->on('users');
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
        Schema::dropIfExists('sub_comentarios');
    }
}
