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
            $table->tinyIncrements('id');
            $table->string('profile_image')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf', 11)->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('role_id', 1)->default('3');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('profile_completed_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
