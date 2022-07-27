<?php

use App\Models\CMS;
use App\Models\Depo;
use App\Models\Logistic;
use App\Models\Service;
use App\Models\User;
use App\Models\Warehouse;
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
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(Warehouse::class)->nullable();
            $table->foreignIdFor(Depo::class)->nullable();
            $table->foreignIdFor(CMS::class)->nullable();
            $table->foreignIdFor(Logistic::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->boolean('manajemen')->default(false);
            $table->integer('harga');
            $table->string('luassewa');
            $table->string('peruntukan')->nullable();
            $table->date('tglmulai');
            $table->date('tglkonfirmasi');
            $table->date('tglakhir');
            $table->string('keterangan')->nullable();
            $table->boolean('selesai')->default(false);
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
