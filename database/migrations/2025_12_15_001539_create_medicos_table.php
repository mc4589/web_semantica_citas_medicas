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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('email', 150)->unique();
            
            //Clave foranea explicita
            $table->foreignId('especialidad_id')
                  ->constrained('especialidades')
                  ->onUpdate('cascade')
                  ->onDelete('restrict')
            
            $table->timestamps();

            $table->index('nombre');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
