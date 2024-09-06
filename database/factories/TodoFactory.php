<?php
namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'status' => 'In progress',
        ];
    }
}