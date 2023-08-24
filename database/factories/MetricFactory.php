<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\Metric;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Metric::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera'];
        $platforms = ['Windows', 'MacOS', 'Linux', 'iOS', 'Android'];

        return [
            'link_id' => rand(1, Link::count()),
            'ip' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'browsers' => $this->faker->randomElement($browsers),
            'system' => $this->faker->randomElement($platforms),
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'), // Gera uma data aleatória nos últimos 30 dias até o presente
        ];
    }
}
