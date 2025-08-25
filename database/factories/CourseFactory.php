<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name(),
            'code'=>$this->faker->unique()->numberBetween(100,999),
            'shortcode'=>$this->faker->unique()->word(),
            'school_id'=>School::inRandomOrder()->first()->id??School::factory()
        ];
    }
}
