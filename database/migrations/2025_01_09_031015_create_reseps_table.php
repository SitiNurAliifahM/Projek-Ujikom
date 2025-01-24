<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_resep');
            $table->foreignId('id_kategori');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->foreignId('id_user');
            $table->enum('status', ['pending', 'approve', 'rejected'])->nullable();
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseps');
    }
};
