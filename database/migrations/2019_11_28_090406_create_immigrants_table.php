<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmigrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immigrants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surname');
            $table->string('firstname');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('gender');
            $table->string('dob');
            $table->string('occupation');
            $table->string('phone_no');
            $table->string('identification')->nullable();
            $table->string('address');
            $table->string('status');
            $table->string('registered_by');
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
        Schema::dropIfExists('immigrants');
    }
}
