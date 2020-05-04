<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancingCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->integer('besaran');
            $table->enum('jenis',['Bayar per Bulan','Sekali Bayar','Per Enam Bulan']);
            $table->timestamps();
        });

        DB::table('financing_categories')->insert(
            array(
                'nama' => 'SPP',
                'besaran' => '0',
                'jenis' => 'Bayar per Bulan',
            )
        );
        DB::table('financing_categories')->insert(
            array(
                'nama' => 'UAS',
                'besaran' => '0',
                'jenis' => 'Bayar per Bulan',
            )
        );
        DB::table('financing_categories')->insert(
            array(
                'nama' => 'Praktikum',
                'besaran' => '0',
                'jenis' => 'Bayar per Bulan',
            )
        );


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financing_categories');
    }
}
