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
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('password')->nullable();
            $table->dateTime('naissance_at');
            $table->string('naissance_lieu');
            $table->string('adresse');
            $table->integer('cp');
            $table->string('ville');
            $table->string('tel');
            $table->string('email');
            $table->string('photo')->nullable();
            $table->string('certif')->nullable();
            $table->dateTime('certif_at')->nullable();
            $table->integer('origine');
            $table->integer('activite');
            $table->integer('licence')->nullable();
            $table->dateTime('licence_at')->nullable();
            $table->dateTime('validation_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
