<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
            $table->string('title')
                ->unique()
                ->comment('文章标题');
            $table->text('main')
                ->comment('正文');
            $table->unsignedInteger('skims')
                ->default(0)
                ->comment('浏览量');
            $table->unsignedInteger('likes')
                ->default(0)
                ->comment('点赞量');
            $table->unsignedInteger('comments')
                ->default(0)
                ->comment('评论量');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
