<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Tag 1',
            ],
            [
                'name' => 'Tag 2',
            ],
            [
                'name' => 'Tag 3',
            ],
            [
                'name' => 'Tag 4',
            ],
        ];

        $existingTags = Tag::get();

        foreach ($tags as $key => $tag) {

            foreach ($existingTags as $existingTag) {

                if ($existingTag->name == $tag['name']) {
                    unset($tags[$key]);
                }
            }
        }

        if (!empty($tags)) {
            foreach ($tags as $key => $tag) {
                $tag = Tag::create([
                    'name' => $tag['name'],
                ]);
            }
        }
    }
}
