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
