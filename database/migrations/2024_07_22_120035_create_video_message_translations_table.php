<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_message_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_message_id')->constrained('videomsg')->onDelete('cascade');
            $table->string('locale', 2);
            $table->string('heading');
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_message_translations');
    }
};
