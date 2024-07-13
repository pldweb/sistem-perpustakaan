<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul_buku' => $this->faker->word(),
            'penulis' => $this->faker->name(),
            'penerbit' => $this->faker->name(),
            'tahun_terbit' => $this->faker->year(),
            'stock' => $this->faker->numberBetween(12,100),
        ];
    }
}
