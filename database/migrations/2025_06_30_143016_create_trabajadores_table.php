<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); 
            $table->string('nombre');
            $table->string('email')->unique();
            $table->integer('horas')->nullable();
            $table->string('nif')->nullable();
            $table->string('pin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['empresa_id', 'nif'], 'unique_empresa_nif');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};