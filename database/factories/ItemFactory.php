<?php

namespace Database\Factories;
use App\Models\Mark;
use App\Models\Version;
use App\Models\Generation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'generation_id' => function (array $attributes) {
                $generation = Generation::where('version_id', $attributes['version_id'])->first();
                return $generation ? $generation->id : null;
            },
            'image' => $this->faker->imageUrl(),
            'cost' => $this->faker->randomFloat(2, 0, 9999),

        ];
    }
}
