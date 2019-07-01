<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')
                ->unique()
                ->comment('文章标签标题');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
