<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('cId',6);
            $table->string('cName',60);
            $table->string('company');
            $table->bigInteger('contact')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('type', ['1', '2','3','4']);
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
        Schema::drop('customers');
    }
}
