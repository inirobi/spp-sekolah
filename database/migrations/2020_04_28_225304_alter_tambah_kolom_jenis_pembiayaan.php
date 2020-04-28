<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTambahKolomJenisPembiayaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financing_categories', function (Blueprint $table) {
            $table->enum('jenis',['Bayar per Bulan', 'Sekali Bayar'])->after('besaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financing_categories', function (Blueprint $table) {
            //
        });
    }
}
