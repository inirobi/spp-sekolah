<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTambahKolomJenisDiFinancingCategoryResets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('financing_category_resets', function (Blueprint $table) {
            $table->enum('jenis',['Bayar per Bulan', 'Sekali Bayar']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('financing_category_resets', function (Blueprint $table) {
            //
        });
    }
}
