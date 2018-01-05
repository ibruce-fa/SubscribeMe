<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('industry')->nullable();
            $table->string('name');
            $table->string('description');
            $table->string('address');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('photo_path')->nullable();
            $table->string('logo_path')->nullable();
            // hours
            $table->string('monday')->nullable();
            $table->string('tuesday')->nullable();
            $table->string('wednesday')->nullable();
            $table->string('thursday')->nullable();
            $table->string('friday')->nullable();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();
            // hours
            $table->integer('zip');
            $table->decimal('lat',10,6);
            $table->decimal('lng',10,6);
            $table->enum('active',[0,1]);
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
        Schema::dropIfExists('businesses');
    }
}
