<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->char('nisn',10)->unique();
            $table->char('nis',8)->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->bigInteger('id_kelas');
            $table->text('alamat');
            $table->char('no_telp',14);
            $table->bigInteger('id_spp');
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
        Schema::dropIfExists('student');
    }
}
