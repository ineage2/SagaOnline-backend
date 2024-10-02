<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $languages = Language::all();
        $tagIds = Tag::pluck('id');

        for ($i = 0; $i < 50; $i++) {
            $news = News::create([
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $randomTagId = $tagIds->random();
            $news->tags()->attach($randomTagId);

            foreach ($languages as $language) {
                $faker = Faker::create($language->iso);

                $imagePatterns = [
                    'https://picsum.photos/500/250?random=1',
                    'https://picsum.photos/500/250?random=2',
                ];

                $imageUrl = $imagePatterns[array_rand($imagePatterns)];

                DB::table('news_translations')->insert([
                    'news_id' =>  $news->id,
                    'language_id' => $language->id,
                    'title' => $faker->realText(50),
                    'description' => $faker->realText(200),
                    'image_url' => $imageUrl,
                    'content' => $faker->realText(2000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
