<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('occupation');
            $table->timestamps();
        });

        # Set default timezone
        date_default_timezone_set('Africa/Lagos');

        # create default data
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [1, 'Accountant', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [2, 'Artiste', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [3, 'Banker', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [4, 'Bricklayer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [5, 'Business', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [6, 'Cobbler', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [7, 'Chainsaw Operator', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [8, 'Clergy', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [9, 'Cleric', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [10, 'Civil Servant', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [11, 'Doctor', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [12, 'Driver', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [13, 'Engineer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [14, 'Farmer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [15, 'Fashion Designer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [16, 'Journalist', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [17, 'Lecturer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [18, 'Lawyer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [19, 'Lotto Agent', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [20, 'Mechanic', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [21, 'Police Officer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [22, 'Software Developer', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [23, 'Soldier', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [24, 'Security Personnel', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [25, 'Teacher', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [26, 'Nil', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO occupations (id, occupation, created_at, updated_at) VALUES (?, ? , ?, ?)', [27, 'Contractor', date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);                
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occupations');
    }
}
