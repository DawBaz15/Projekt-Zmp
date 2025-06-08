<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('userNotifications', function (Blueprint $table) {
            $table->id();
            $table->integer('UserID');
            $table->string('Title');
            $table->string('Message');
            $table->primary('ID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
