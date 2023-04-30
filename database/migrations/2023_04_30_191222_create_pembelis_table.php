<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::dropIfExists('pembeli');
}

public function down()
{
    Schema::create('pembeli', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->date('tanggal_lahir');
        $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        $table->text('alamat');
        $table->string('foto_ktp')->nullable();
        $table->string('user');
        $table->string('password');
        $table->timestamps();
    });
}

}
