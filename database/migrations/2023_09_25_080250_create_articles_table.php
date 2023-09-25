<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('journal')->comment('期数');
            $table->string('title')->comment('标题');
            $table->string('description',1000)->comment('描述');
            $table->string('keywords',1000)->comment('关键词');
            $table->string('cover')->comment('封面');
            $table->boolean('status')->default(0)->comment('是否发布 1是 0否');
            $table->unsignedInteger('click')->default(0)->comment('点击数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
