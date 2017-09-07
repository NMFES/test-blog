<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Post::truncate();

        // delete old files before seeding
        File::delete(File::glob(storage_path('app/public') . '/images/posts/*.jpg'));

        $faker = Factory::create();

        // getting template images
        $files = collect(File::glob(storage_path('app/public') . '/images/templates/posts/*.jpg'));

        for ($i = 1; $i <= 30; $i++) {
            $post = Post::create([
                        'title' => $faker->sentence(6),
                        'slug' => $faker->slug(5),
                        'description' => $faker->sentence(100),
                        'content' => $faker->sentence(500),
                        'status' => mt_rand(0, 1)
            ]);

            // around 25% of posts will be without image
            if (mt_rand(0, 3)) {
                Storage::disk('public')->copy('images/templates/posts/' . basename($files->random()), 'images/posts/' . $post->id . '.jpg');
            }
        }
    }

}
