<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Default Laravel schema, with the PK renamed to user_id to match
            // the rest of the app's custom-primary-key convention.
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Additional fields on top of the default schema.
            $table->unsignedBigInteger('role_id');
            $table->string('user_alias', 32)->nullable();
            $table->boolean('user_status')->default(false);

            $table->timestamps();

            $table->foreign('role_id')->references('role_id')->on('roles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
