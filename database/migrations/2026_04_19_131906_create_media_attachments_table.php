<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Campos Polimórficos
            $table->unsignedBigInteger('mediable_id');
            $table->string('mediable_type'); // App\Models\Site o App\Models\Discovery

            $table->string('file_path');
            $table->enum('file_type', ['image', 'audio', 'video', 'document']);
            $table->boolean('is_public')->default(false); // Para mostrar en la Landing o no

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_attachments');
    }
};
