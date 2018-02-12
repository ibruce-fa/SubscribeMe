<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("type",['common', 'consumer', 'business']);
            $table->integer('on_behalf_of_id'); // will work in conjunction with the type to determine if this needs to be business or user id
            $table->string('on_behalf_of_email'); // will work in conjunction with the type to determine if this needs to be business or user id
            $table->string('recipient_email');
            $table->integer('recipient_id');
            $table->string('subject');
            $table->text('body');
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
        Schema::dropIfExists('notifications');
    }
}
