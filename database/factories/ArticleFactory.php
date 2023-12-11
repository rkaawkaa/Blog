<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;
    public function definition(): array
    {
        $categories = ["Finance", "Technologie", "Société", "Actualités", "Politique"];
        $status = ["Brouillon", "En révision", "Publié", "Archivé"];

        return [
            'title' => fake()->sentence(),
            'description' => fake()->text(200),
            'category' => fake()->randomElement($categories),
            'status' => fake()->randomElement($status),
        ];
    }
}
