<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_urut', 2);
            $table->char('nama_CaGub', 100);
            $table->char('nama_CaWaGub', 100);
            $table->text('visi', 1000);
            $table->text('misi', 1000);
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
        Schema::dropIfExists('calon');
    }
}
