<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Arqueólogo creador

            // Datos Generales / Públicos
            $table->string('name');
            $table->string('province'); // Ej: Duarte, La Vega
            $table->string('period')->nullable(); // Ej: Precolombino, Colonial
            $table->text('public_description'); // Lo que verá la Landing Page

            // Datos Sensibles / Privados (Solo Admin y Creador, o Colegas en modo lectura)
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('elevation')->nullable(); // Altitud sobre el nivel del mar
            $table->enum('threat_level', ['none', 'low', 'medium', 'high'])->default('none'); // Riesgo de saqueo/destrucción
            $table->text('technical_notes')->nullable(); // Notas geomorfológicas

            $table->enum('status', ['pending', 'approved'])->default('pending'); // Aprobación del Ministerio
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
