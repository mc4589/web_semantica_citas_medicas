<?php

namespace App\Models;

use App\Traits\HasJsonLd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidad extends Model
{
    use HasFactory, HasJsonLd;

    protected $table = 'especialidades';
    protected $fillable = ['nombre'];
    
    // Define las relaciones que deben cargarse si este modelo fuera la entidad principal en una respuesta
    protected array $jsonLdRelations = ['medicos'];

    /**
     * Relación: Una especialidad tiene muchos médicos.
     */
    public function medicos(): HasMany
    {
        return $this->hasMany(Medico::class);
    }

    /**
     * Mapeo a JSON-LD (MedicalSpecialty)
     */
    public function toJsonLd(): array
    {
        return [
            '@context' => 'http://schema.org',
            '@type' => 'MedicalSpecialty',
            'identifier' => $this->id,
            'name' => $this->nombre,
           
        ];
    }
}
