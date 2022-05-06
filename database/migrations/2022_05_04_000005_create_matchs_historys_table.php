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
        Schema::create('matchs_historys', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('matchs_id')->references('id')->on('matchs');
            $table->integer('winning_player');
            $table->json('board_plays');

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
        Schema::dropIfExists('matchs_historys');
    }
};
