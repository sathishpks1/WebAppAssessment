<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleArchiveTable extends Migration
{
    public function up()
    {
        Schema::create('people_archive', function (Blueprint $table) {
            $table->id();
            $table->string('member_id');
            $table->string('name');
            $table->string('email');
            // Add other fields if needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people_archive');
    }
}

