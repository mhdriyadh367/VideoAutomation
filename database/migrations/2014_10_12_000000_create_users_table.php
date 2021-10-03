<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('sid');
            $table->string('nik');
            $table->string('nik_ktp');
            $table->string('password');
            $table->bigInteger('id_company');
            $table->bigInteger('id_department');
            $table->text('pjo');
            $table->text('struktural');
            $table->text('fungsional');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('telp');
            $table->text('alamat');
            $table->integer('dedicated_site');
            $table->string('nama_site');
            $table->enum('isactive', ['1', '0']);
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
        Schema::dropIfExists('users');
    }
}
