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
        Schema::create('okky_hendrawan1462200279_tikets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->decimal('harga_tiket', 8, 2); // Assuming the ticket price is a decimal
            $table->string('gambar');
            $table->tinyInteger('is_delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('okky_hendrawan1462200279_tikets');
    }
};
