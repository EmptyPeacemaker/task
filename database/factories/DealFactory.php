<?php

namespace Database\Factories;

use App\Models\Deal;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Deal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'img'=>null,
            'title'=>$this->faker->realText(30),
            'text'=>$this->faker->realText(),
            'price'=>rand(0,99999),
            'executor_id'=>null,
            'author_id'=>null,
            'status_id'=>$this->faker->randomElement(Status::all()),
        ];
    }
}
