<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message');
            $table->integer('sent_by')->unsigned();
            
            $table->integer('chat_room_id')->unsigned();
            
            $table->timestamps();

            $table->engine = "InnoDB";

            $table->foreign('sent_by')->references('id')->on('users');
            $table->foreign('chat_room_id')->references('id')->on('chat_rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
