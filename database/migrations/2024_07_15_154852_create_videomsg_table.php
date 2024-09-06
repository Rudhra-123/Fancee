<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('videomsg', function (Blueprint $table) {
            $table->id();
            $table->string('heading'); // Heading
            $table->text('message'); // Message
            $table->string('language', 2);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('videomsg');
    }
};
