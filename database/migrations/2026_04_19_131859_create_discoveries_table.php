<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discoveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('registration_code')->unique(); // ARQ-2026-001
            $table->string('name');
            $table->string('material_category'); // Lítico, Cerámico, Óseo, Concha, Metal
            $table->string('conservation_status'); // Intacto, Fragmentado, Restaurado
            $table->boolean('is_extracted')->default(true); // ¿Se extrajo o se dejó en el sitio (in situ)?

            // Datos Técnicos / Estratigráficos (Privados)
            $table->string('stratigraphic_layer')->nullable(); // Ej: Capa III, Nivel 2
            $table->decimal('depth_cm', 6, 2)->nullable(); // Profundidad en cm
            $table->text('private_notes')->nullable();

            // Lo que verá el público
            $table->text('public_description')->nullable();
            $table->boolean('is_public')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discoveries');
    }
};
