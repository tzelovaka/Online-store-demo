<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mark;
use App\Models\Version;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Version>
 */
class VersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Version::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'mark_id' => Mark::inRandomOrder()->first()->id,
        ];
    }
}
