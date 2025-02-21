<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropRolesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('roles');
    }

    public function down()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->timestamps();
        });
    }
}
