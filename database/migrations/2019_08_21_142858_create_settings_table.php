<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('title')->nullable()->comment('标题');
            $table->string('sketch')->nullable()->comment('简介');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
