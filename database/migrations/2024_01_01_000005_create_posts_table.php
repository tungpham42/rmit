<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('repost_id')->nullable();
            $table->smallInteger('post_week');
            $table->string('post_title')->default('');
            $table->string('post_url', 60);
            $table->text('post_question');
            $table->text('post_answer');
            $table->boolean('post_hide_name')->default(false);
            $table->boolean('post_current')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->fullText(['post_title', 'post_question', 'post_answer']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
