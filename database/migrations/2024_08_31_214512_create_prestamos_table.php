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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->decimal('tasa_interes', 5, 2); // Tasa de interés
            $table->date('fecha_prestamo');
            $table->enum('cuotas', ['diaria', 'semanal', 'quincenal', 'mensual', 'semestral', 'anual'])->default('mensual'); // Opciones de cuotas
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }

};
