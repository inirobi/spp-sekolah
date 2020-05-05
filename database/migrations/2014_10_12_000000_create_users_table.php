<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',['Sekolah','Yayasan']);
            $table->rememberToken();
            $table->timestamps();
        });

        $p = bcrypt('12345');
        // Insert some stuff
        DB::table('users')->insert(
            array(
                'email' => 'admin@support.com',
                'name' => 'admin',
                'password' => $p,
                'role' => 'Sekolah',
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
        Schema::dropIfExists('users');
    }
}
