<?php

namespace Database\Factories;

use App\Models\Tarea;
use Illuminate\Database\Eloquent\Factories\Factory;

class TareaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('TAR-####'),
            'titulo' => rtrim(fake()->sentence(4), '.'),
            'descripcion' => fake()->optional()->paragraph(),
            'fecha_limite' => fake()->dateTimeBetween('now', '+60 days')->format('Y-m-d'),
            'estado' => fake()->randomElement(Tarea::ESTADOS),
        ];
    }
}