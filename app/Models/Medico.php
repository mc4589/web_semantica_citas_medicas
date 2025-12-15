<?php

namespace App\Models;

use App\Traits\HasJsonLd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medico extends Model
{
    use HasFactory, HasJsonLd;

    protected $fillable = ['nombre', 'email', 'especialidad_id'];
    
    protected array $jsonLdRelations = ['especialidad', 'citas'];

    /**
     * Relación: Un médico tiene muchas citas
     */
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    /**
     * Relación: Un médico pertenece a una especialidad
     */
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class);
    }

    /**
     * Mapeo a JSON-LD (Physician)
     */
    public function toJsonLd(): array
    {
        $this->loadMissing('especialidad'); // Carga la especialidad si no está cargada

        return [
            '@context' => 'http://schema.org',
            '@type' => 'Physician',
            'identifier' => $this->id,
            'name' => $this->nombre,
            'email' => $this->email,
            // Incluye solo una referencia de la especialidad
            'medicalSpecialty' => $this->especialidad
                ? $this->especialidad->toReferenceJsonLd() 
                : null,
        ];
    }
}
