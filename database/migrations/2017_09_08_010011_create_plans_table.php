<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stripe_plan_xid');
            $table->string('stripe_plan_name');
            $table->integer('year_price')->nullable();
            $table->integer('month_price')->nullable();
            $table->enum('is_app_plan',[0,1]);
            $table->integer('use_limit')->default(0);
            $table->integer('business_id')->default(0);
            $table->integer('user_id')->nullable();
            $table->string('featured_photo_path')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
