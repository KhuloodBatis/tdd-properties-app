<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
     /**
	 * The name of the factory's corresponding model. * * @var string
	 */
	//  protected $model = Property::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type'=>$this->faker->word,
            'price'=>$this->faker->randomNumber(6),
            'description' => $this->faker->paragraph,
        ];
    }
}
