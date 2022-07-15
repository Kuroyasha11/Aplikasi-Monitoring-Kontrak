<?php

use App\Models\Storage;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('jenislayanan');
            $table->string('namagudang');
            $table->string('manajemen');
            $table->string('namapelanggan');
            $table->integer('harga');
            $table->string('luassewa');
            $table->string('peruntukan');
            $table->date('tglmulai');
            $table->date('tglakhir')->nullable();
            $table->integer('sisasewa')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('contracts');
    }
};
