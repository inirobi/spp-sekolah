<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancingCategoryResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financing_category_resets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('financing_category_id');
            $table->integer('besaran');
            $table->enum('jenis',['Bayar per Bulan','Sekali Bayar']);
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
        Schema::dropIfExists('financing_category_resets');
    }
}
