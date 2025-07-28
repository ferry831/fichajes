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
        Schema::create('pausas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fichaje_id')->constrained('fichajes')->onDelete('cascade');
            $table->timestamp('inicio');
            $table->timestamp('fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pausas');
    }
};
