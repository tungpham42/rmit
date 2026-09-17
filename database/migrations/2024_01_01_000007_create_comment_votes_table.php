<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comment_votes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id');
            $table->integer('comment_vote_like')->default(0);
            $table->integer('comment_vote_dislike')->default(0);
            $table->timestamps();

            $table->index('user_id');
            $table->index('comment_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('comment_id')->references('comment_id')->on('comments');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comment_votes');
    }
};
