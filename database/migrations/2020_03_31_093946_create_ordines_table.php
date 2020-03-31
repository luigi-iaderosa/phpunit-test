<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('articolo_id');
            $table->integer('user_id');
            $table->boolean('chiuso')->default(false);
            $table->boolean('annullato')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordines');
    }
}
