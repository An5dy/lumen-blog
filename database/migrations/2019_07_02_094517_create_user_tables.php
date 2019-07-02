<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTables extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')
                ->comment('用户名');
            $table->string('account')
                ->unique()
                ->comment('账号');
            $table->string('password')
                ->comment('密码');
            $table->text('api_token')
                ->nullable()
                ->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
