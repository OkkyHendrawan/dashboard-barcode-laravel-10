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
        Schema::create('okky_hendrawan1462200279_homes', function (Blueprint $table) {
            $table->id();
            $table->string('nbi')->unique(); // Assuming nbi should be unique
            $table->string('nama');
            $table->tinyInteger('is_delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('okky_hendrawan1462200279_homes');
    }
};
