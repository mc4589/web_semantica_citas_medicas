<?php

namespace App\Models;

use App\Traits\HasJsonLd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory, HasJsonLd;

    protected $fillable = [
        'fecha', 'hora', 'descripcion', 'medico_id', 'paciente_id'
    ];
    
    protected array $jsonLdRelations = ['medico', 'paciente'];

    /**
     * Relación: Una cita pertenece a un médico
     */
    public function medico(): BelongsTo
    {
        return $this->belongsTo(Medico::class);
    }

    /**
     * Relación: Una cita pertenece a un paciente
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    /**
     * Mapeo a JSON-LD (MedicalAppointment)
     */
    public function toJsonLd(): array
    {
        $this->loadMissing(['medico', 'paciente']); // Asegura que las relaciones estén cargadas

        return [
            '@context' => 'http://schema.org',
            '@type' => 'MedicalAppointment',
            'identifier' => $this->id,
            'description' => $this->descripcion,
            // Combinamos fecha y hora en formato ISO 8601 para la propiedad 'scheduledTime'
            'scheduledTime' => $this->fecha . 'T' . $this->hora, 
            
            // Incluimos referencias anidadas para médico y paciente
            'doctor' => $this->medico 
                ? $this->medico->toJsonLd() 
                : null,
            
            'patient' => $this->paciente 
                ? $this->paciente->toJsonLd() 
                : null,
        ];
    }
}
