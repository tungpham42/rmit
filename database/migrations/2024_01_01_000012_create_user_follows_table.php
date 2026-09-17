<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_follows', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('followee_id');
            $table->timestamps();

            $table->index('user_id');
            $table->index('followee_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('followee_id')->references('user_id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_follows');
    }
};
