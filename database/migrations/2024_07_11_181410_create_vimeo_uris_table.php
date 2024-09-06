<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVimeoUrisTable extends Migration
{
    public function up()
    {
        Schema::create('vimeo_uris', function (Blueprint $table) {
            $table->id();
            $table->string('uri');
            $table->timestamps();
        });
    }
     
    public function down()
    {
        Schema::dropIfExists('vimeo_uris');
    }
}
