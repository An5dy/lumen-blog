<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')
                ->nullable()
                ->comment('父级 ID');
            $table->unsignedInteger('level')
                ->default(0)
                ->comment('层级');
            $table->string('path')
                ->default('-')
                ->comment('层级路径');
            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_parent_id_foreign');
            $table->dropColumn(['parent_id', 'level', 'path']);
        });
    }
}
