<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;

class CitaFactory extends Factory
{
   protected $model = Cita::class;
    
   public function definition(): array
    {
        return [
            'fecha' => $this->faker->dateTimeBetween('+1 day', '+1 year')->format('Y-m-d'),
            'hora' => $this->faker->time('H:i:s'),
            'descripcion' => $this->faker->optional(0.9)->sentence(), //90% tienen descripcion
            
            //Crea o elige medico y pacientes existentes
            'medico_id' => Medico::inRandomOrder()->first() ?? Medico::factory(),
            'paciente_id' => Paciente::inRandomOrder()->first() ?? Paciente::factory(),
        ];
    }
}
