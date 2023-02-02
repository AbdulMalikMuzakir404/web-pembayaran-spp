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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 25)->nullable();
            $table->string('password', 70)->nullable();
            $table->string('email', 70)->unique();
            $table->string('nama', 35)->nullable();
            $table->enum('level', ['admin', 'petugas', 'siswa']);

            $table->string('image', 70)->nullable();

            $table->unsignedBigInteger('ruang_id')->nullable();
            $table->index('ruang_id');
            $table->foreign('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');

            $table->unsignedBigInteger('spp_id')->nullable();
            $table->index('spp_id');
            $table->foreign('spp_id')->references('id')->on('spps')->onDelete('cascade');

            $table->string('nisn', 10)->unique()->nullable();
            $table->string('nis', 8)->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp', 13)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
};