<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NIK', 16);
            $table->string('nama', 100);
            $table->date('tgl_lahir');
            $table->integer('id_tps')->index('id_tps_foreign');
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
        Schema::dropIfExists('voter');
    }
}
