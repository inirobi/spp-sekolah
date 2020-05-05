<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('kelas',['X','XI','XII']);
            $table->integer('major_id');
            $table->bigInteger('nominal');
            $table->timestamps();
        });

        $m_id = [1,2,3];
        $k_id = ["X","XI","XII"];
        foreach ($m_id as $m) {
            foreach ($k_id as $k) {
                DB::table('kelas')->insert(
                array(
                    'kelas' => $k,
                    'major_id' => $m,
                    'nominal' => 0,
                    )
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
