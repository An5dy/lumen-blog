<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('avatar')->comment('头像');
            $table->string('title')->comment('标题');
            $table->string('sketch')->comment('简介');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
