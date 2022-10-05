<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createentity_nameTable extends Migration
{
    public function up()
    {
        Schema::create('db_name', function (Blueprint $table) {
            $table->bigIncrements('id');
            // DB_ATTRIBUTES$table->timestamps();
            $table->softDeletes();
        });
    }
}
