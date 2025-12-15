<?php

namespace App\Traits;

trait HasJsonLd
{
    /**
     * Convierte el modelo a formato JSON-LD de Schema.org.
     *
     * @return array
     */
    abstract public function toJsonLd(): array;

    /**
     * Convierte el modelo a una representación mínima para ser usado en referencias JSON-LD.
     *
     * @return array
     */
    public function toReferenceJsonLd(): array
    {
        return [
            '@context' => 'http://schema.org',
            '@type' => class_basename($this), // Usamos el nombre de la clase como tipo por defecto
            'identifier' => $this->id,
            'name' => $this->nombre ?? $this->id,
        ];
    }
}
