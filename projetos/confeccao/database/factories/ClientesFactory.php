<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clientes>
 */
class ClientesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->unique()->numerify('###.###.###-##'),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake('pt_BR')->numerify('(##) #####-####'),
            'endereco' => fake()->address(),
            'reserva' => fake()->boolean(),
        ];
    }
}