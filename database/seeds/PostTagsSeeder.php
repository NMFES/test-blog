<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;
use App\PostTag;

class PostTagsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $tags = Tag::all();

        PostTag::truncate();

        foreach (Post::all() as $post) {
            $selectedTags = $tags->random(mt_rand(0, 3));

            foreach ($selectedTags as $tag) {
                PostTag::create([
                    'post_id' => $post->id,
                    'tag_id' => $tag->id
                ]);
            }
        }
    }

}
