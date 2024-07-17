<?php

namespace Database\Seeders;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        //$tags = Tag::all();
        $users = User::all();

        Post::factory(20)
        ->sequence(fn () => [   // Pour recuperer une valeur aleatoire pour un champ
            'category_id' => $categories->random(),
        ])
        ->hasComments(5, fn () => ['user_id' => $users->random()])
        ->create()
        //each(fn ($post) =>  $post->tags()->attach($tags->random(rand(0, 6))));
        ->each(function ($post) {
            $tags = Tag::all()->random(rand(0, 3));
            $post->tags()->attach($tags);
        });

    }
}
