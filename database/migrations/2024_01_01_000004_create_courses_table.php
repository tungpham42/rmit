<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('course_name')->default('');
            $table->string('course_code')->default('');
            $table->boolean('course_allowed')->default(false);
            $table->boolean('course_for_guest')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
