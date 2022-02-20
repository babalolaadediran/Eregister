<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });

        # Set default timezone
        date_default_timezone_set('Africa/Lagos');
        
        # create default data
        DB::insert('INSERT INTO administrators (fullname, email, phone, username, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)', ['Administrator', 'admin@admin.com', '012345678910', 'administrator', \Hash::make('password'), date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
