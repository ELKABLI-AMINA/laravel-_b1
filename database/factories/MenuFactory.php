<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {  
        $title=fake()->title();
         return [
            
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->title(),
            'image'=>fake()->imageUrl(640,480),
        ];
    }
}
