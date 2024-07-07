<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('okky_hendrawan1462200279_transaksis', function (Blueprint $table) {
            $table->id();
            $table->decimal('harga_tiket', 12, 2);
            $table->unsignedBigInteger('wisata_id');
            $table->tinyInteger('is_delete');
            $table->timestamps();

            $table->foreign('wisata_id')
                  ->references('id')
                  ->on('okky_hendrawan1462200279_tikets')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('okky_hendrawan1462200279_transaksis');
    }
};
