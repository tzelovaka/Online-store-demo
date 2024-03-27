<?php

namespace Database\Factories;
use App\Models\Generation;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generation>
 */
class GenerationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Generation::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'version_id' => Version::inRandomOrder()->first()->id,

        ];
    }
}
