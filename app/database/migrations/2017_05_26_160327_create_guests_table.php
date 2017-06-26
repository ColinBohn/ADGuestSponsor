<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('purpose');
            $table->string('location');
            $table->string('username')->unique();
            $table->string('password');
            $table->date('expiration');	
            $table->string('dn');
            $table->string('cn');
            $table->string('sponsorDn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
