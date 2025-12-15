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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->text('descripcion')->nullable();
            
            //Clave foranea explicita a medicos
            $table->foreignId('medico_id')
                  ->constrained('medicos')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            //Clave foranea explicita a pacientes
            $table->foreignId('paciente_id')
                  ->constrained('pacientes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
               
            $table->timestamps();

            //Indice compuesto para busquedas comunes (ej. citas por medico y fecha)
            $table->index(['medico_id', 'fecha']);
            $table->index(['paciente_id', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
