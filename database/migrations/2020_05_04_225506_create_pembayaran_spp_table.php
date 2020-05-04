<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranSppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_spp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id');
            $table->date('bulan');
            $table->string('tahun_ajaran');
            $table->enum('status',['Lunas','Nunggak','Waiting'])->default('Waiting');
            $table->bigInteger('nominal');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('pembayaran_spp');
    }
}
