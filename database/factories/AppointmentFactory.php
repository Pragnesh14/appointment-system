<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'doctor_id' => $this->faker->numberBetween(1, 10),
            'patient_id' => $this->faker->numberBetween(1, 10),
            'start_time' => now(),
            'finish_time' => now(),
            'price' => $this->faker->numberBetween(0, 9999),
            'comments' => $this->faker->sentence(20),
        ];
    }
}
