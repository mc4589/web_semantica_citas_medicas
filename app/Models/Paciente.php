<?php

namespace App\Models;

use App\Traits\HasJsonLd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory, HasJsonLd;

    protected $fillable = ['nombre', 'email', 'telefono'];
    
    protected array $jsonLdRelations = ['citas'];

    /**
     * Relación: Un paciente tiene muchas citas
     */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    /**
     * Mapeo a JSON-LD (Patient)
     */
    public function toJsonLd(): array
    {
        return [
            '@context' => 'http://schema.org',
            '@type' => 'Patient', // Tipología JSONLD específica para pacientes
            'identifier' => $this->id,
            'name' => $this->nombre,
            'email' => $this->email,
            'telephone' => $this->telefono,
        ];
    }
}
