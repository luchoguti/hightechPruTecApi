<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid ('id')->primary ();
            $table->text('names');
            $table->text('last_names');
            $table->enum ('type_identification',['Identification Card', 'Passport','NIT']);
            $table->bigInteger('number_identification');
            $table->char('id_credit_card')->nullable();
            //$table->foreign('id_credit_card')->references('id')->on('credit_cards');
            //$table->string('email')->unique();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}