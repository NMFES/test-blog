<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Tag;

class TagsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Tag::truncate();

        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            Tag::create([
                'title' => $faker->sentence(1),
                'slug' => $faker->slug(1)
            ]);
        }
    }

}
