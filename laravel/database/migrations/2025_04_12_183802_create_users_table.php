<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Email');
            $table->string('Phone');
            $table->string('Name');
            $table->string('Surname');
            $table->string('Password');
            $table->date('AccountDate');
            $table->boolean('AccountActive');
            $table->string('_token');
            $table->primary('ID');
            $table->unique('_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
