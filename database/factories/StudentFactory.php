<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\Session;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enroll_number'=>$this->faker->unique()->randomNumber(),
            'name'=>$this->faker->name(),
            'father_name'=>$this->faker->name,
            'dob'=>$this->faker->date('d-m-Y'),
            'course_id'=>Course::inRandomOrder()->first()->id??Course::factory,
            'session_id'=>Session::inRandomOrder()->first()->id??Session::factory,
            'status'=>$this->faker->randomElement(['active','inactive'])
        ];
    }
}
