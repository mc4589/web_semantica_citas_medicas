<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especialidad>
 */
class EspecialidadFactory extends Factory
{
    protected $model = Especialidad::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => this->faker->unique()->randomElement([
                'Cardiologia',
                'Pediatria',
                'Dermatologia',
                'Neurologia',
                'Gastroenterologia',
                'Oftalmologia',                                             
                'Ortopedia',
                'Ginecologia',
                'Urologia',
                'Medicina General',
                'Psiquiatria',                                            
                'Endocrinologia',
                'Neumologia',
                'Oncologia',
                'Reumatologia',
            ])                                                 
        ];
    }
}
