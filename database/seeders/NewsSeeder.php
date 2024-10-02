<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Language;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $languages = Language::all();

        for ($i = 0; $i < 50; $i++) {
            $news_id = DB::table('news')->insertGetId([
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ]);

            foreach ($languages as $language) {
                $faker = Faker::create($language->iso);

                $imagePatterns = [
                    'https://picsum.photos/500/250?random=1',
                    'https://picsum.photos/500/250?random=2',
                    'https://picsum.photos/500/250?random=3',
                ];

                $imageUrl = $imagePatterns[array_rand($imagePatterns)];

                DB::table('news_translations')->insert([
                    'news_id' => $news_id,
                    'language_id' => $language->id,
                    'title' => $faker->realText(50),
                    'description' => $faker->realText(200),
                    'image_url' => $imageUrl,
                    'content' => $faker->realText(2000),
                    'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-3 months', 'now'),
                ]);
            }
        }
    }
}
