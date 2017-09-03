<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Factory;

class PostsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Post::truncate();

        $faker = Factory::create();

        for ($i = 1; $i <= 30; $i++) {
            Post::create([
                'title' => $faker->sentence(6),
                'slug' => $faker->slug(5),
                'description' => $faker->sentence(100),
                'content' => $faker->sentence(500),
                'meta_description' => $faker->sentence(20),
                'meta_keywords' => implode(', ', explode(' ', $faker->sentence(20))),
                'status' => mt_rand(0, 1)
            ]);
        }
    }

}
