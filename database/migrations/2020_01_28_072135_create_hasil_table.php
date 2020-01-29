<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pasangan1', 100);
            $table->string('jml_suara_pasangan1', 100);
            $table->string('pasangan2', 100);
            $table->string('jml_suara_pasangan2', 100);
            $table->string('total_suara_masuk', 100);
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
        Schema::dropIfExists('hasil');
    }
}
