<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3, true);
        $paragraphs = $this->faker->paragraphs(6);
        $content = collect($paragraphs)->map(fn ($p) => "<p>{$p}</p>")->implode("\n");

        $categories = ['Property Investment', 'Market Analysis', 'Investment Tips', 'Real Estate News'];

        return [
            'title' => ucfirst($title),
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(24),
            'content' => $content,
            'featured_image' => null, // assigned in seeder when copying demo images
            'author' => 'Jellen Govender',
            'tags' => [$this->faker->word, $this->faker->word],
            'category' => $this->faker->randomElement($categories),
            'is_published' => true,
            'status' => 'published',
            'views' => $this->faker->numberBetween(30, 1500),
            'reading_time' => $this->faker->numberBetween(3, 9),
            'meta_title' => null,
            'meta_description' => null,
        ];
    }
}


