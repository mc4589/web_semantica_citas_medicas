<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasJsonLd
{
    /**
     * Carga automáticamente las relaciones definidas en $jsonLdRelations
     * antes de generar el JSON-LD.
     */
    protected function prepareJsonLd()
    {
        if (property_exists($this, 'jsonLdRelations') && is_array($this->jsonLdRelations)) {
            $this->loadMissing($this->jsonLdRelations);
        }
    }

    /**
     * Convierte el modelo a formato JSON-LD completo.
     * Los modelos que usan este trait deben implementar su propia lógica.
     *
     * @return array
     */
    public function toJsonLd(): array
    {
        // Carga relaciones necesarias
        $this->prepareJsonLd();

        // Implementación base mínima (los modelos la sobrescriben)
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->getJsonLdType(),
            'identifier' => $this->id,
        ];
    }

    /**
     * Representación mínima para referencias anidadas (ej. especialidad dentro de médico).
     *
     * @return array
     */
    public function toReferenceJsonLd(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->getJsonLdType(),
            'identifier' => $this->id,
            'name' => $this->nombre ?? $this->name ?? (string)$this->id,
        ];
    }

    /**
     * Devuelve el tipo Schema.org correspondiente al modelo.
     * Los modelos pueden sobrescribir este método si necesitan un tipo específico.
     *
     * @return string
     */
    protected function getJsonLdType(): string
    {
        // Mapeo común: se puede personalizar según el modelo
        return match (class_basename($this)) {
            'Cita' => 'MedicalAppointment',
            'Medico' => 'Physician',
            'Paciente' => 'Patient',
            'Especialidad' => 'MedicalSpecialty',
            default => class_basename($this),
        };
    }
}
