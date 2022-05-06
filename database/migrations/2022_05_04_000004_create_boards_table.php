<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('matchs_id')->references('id')->on('matchs');
            $table->integer('first_player')->default(1);// hace referncia a el jugador que inica cada juego
            $table->integer('shift')->default(1);//Jugador en turno 1 anfitrion 2 invitado
            $table->foreignId('boards_type_id')->references('id')->on('boards_types');// El tipo de tablero da la posibilidad de jugar con un tablero 3x3 o 4x4 proxima versiob 5x5 XD y los que se configuren XD
            $table->json('board_fields');

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
        Schema::dropIfExists('boards');
    }
};
