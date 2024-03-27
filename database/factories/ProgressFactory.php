<?php

namespace Database\Factories;

use App\Models\Progress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    protected $model = Progress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'user_id'=> $user->id,
            'weight' => fake()->randomNumber(),
            'height' => fake()->randomNumber(),
            'waist_line' => fake()->randomNumber(),
            'bicep_thickness' => fake()->randomNumber(),
            'pec_width' =>fake()->randomNumber(),
            'performance' => fake()->text(),
            'additional_notes' => fake()->text()
        ];
    }
}
