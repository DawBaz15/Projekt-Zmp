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

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('Email');
            $table->string('Phone');
            $table->string('Name');
            $table->string('Surname');
            $table->string('Password');
            $table->date('AccountDate');
            $table->boolean('AccountActive');
            $table->string('_token');
            $table->string('Google2fa');
            $table->primary('ID');
            $table->unique('_token');
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->primary('ID');
        });

        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->integer('ProductID');
            $table->integer('Amount');
            $table->string('Location');
            $table->date('Date');
            $table->boolean('IsActive');
            $table->primary('ID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('items');
        Schema::dropIfExists('stock');
    }
};
