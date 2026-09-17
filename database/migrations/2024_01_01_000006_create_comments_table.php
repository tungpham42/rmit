<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->longText('comment_body')->nullable();
            $table->boolean('comment_hide_name')->default(false);
            $table->timestamps();

            $table->foreign('post_id')->references('post_id')->on('posts')->nullOnDelete();
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
