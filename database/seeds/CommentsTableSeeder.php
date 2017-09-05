<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Faker\Factory;

class CommentsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Comment::truncate();

        $faker = Factory::create();

        $ids = [];

        for ($i = 1; $i <= 50; $i++) {
            $parentID = 0;

            if (!mt_rand(0, 3) && count($ids)) {
                $parentID = array_random($ids);
            }

            $comment = Comment::create([
                        'name' => $faker->name(),
                        'email' => $faker->email(),
                        'message' => $faker->sentence(mt_rand(5, 30)),
                        'parent_id' => $parentID
            ]);

            $ids[] = $comment->id;
        }
    }

}
