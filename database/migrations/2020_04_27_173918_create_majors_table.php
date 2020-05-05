<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('majors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->timestamps();
        });
        DB::table('majors')->insert(
            array(
                'nama' => 'Administrasi Perkantoran',
            )
        );
        DB::table('majors')->insert(
            array(
                'nama' => 'Manajemen Multimedia',
            )
        );
        DB::table('majors')->insert(
            array(
                'nama' => 'Keperawatan',
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
        Schema::dropIfExists('majors');
    }
}
