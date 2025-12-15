<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
     /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear 10 Especialidades (sin dependencias)
        Especialidad::factory(10)->create();
        // 2. Crear 100 Pacientes (sin dependencias)
        Paciente::factory(100)->create();
        // 3. Crear 100 Médicos (depende de Especialidad)
        Medico::factory(100)->create();
        // 4. Crear 100 Citas (depende de Médico y Paciente)
        Cita::factory(100)->create();
        
        $total = Especialidad::count() + Paciente::count() + Medico::count() + Cita::count();
        echo "Base de datos poblada exitosamente.\n";
        echo "Total de registros creados:{$total}.\n'; //Deben poblarse 310 registros en mysql
    }
}
