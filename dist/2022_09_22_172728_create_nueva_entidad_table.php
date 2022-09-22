<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNuevaEntidadTable extends Migration
{
    public function up()
    {
        Schema::create('nueva_entidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug'); 
			$table->string('descripcion'); 
			$table->integer('id'); 
			$table->integer('quantity'); 
			$table->float('amount'); 
			$table->timestamps();
            $table->softDeletes();
        });
    }
}
