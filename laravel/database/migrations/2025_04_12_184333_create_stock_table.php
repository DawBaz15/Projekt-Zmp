<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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
        Schema::dropIfExists('stock');
    }
};
