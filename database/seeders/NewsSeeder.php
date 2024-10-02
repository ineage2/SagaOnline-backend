<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $news_id = DB::table('news')->insertGetId([
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ]);

            $languages = [
                ['code' => 'en', 'language_id' => 1, 'faker' => Faker::create('en_US')],
                ['code' => 'ja', 'language_id' => 2, 'faker' => Faker::create('ja_JP')],
                ['code' => 'ru', 'language_id' => 3, 'faker' => Faker::create('ru_RU')],
                ['code' => 'zh', 'language_id' => 4, 'faker' => Faker::create('zh_TW')],
            ];

            foreach ($languages as $language) {
                $imagePatterns = [
                    'https://picsum.photos/500/250?random=1',
                    'https://picsum.photos/500/250?random=2',
                    'https://picsum.photos/500/250?random=3',
                    'https://picsum.photos/500/250?random=4',
                    'https://picsum.photos/500/250?random=5',
                    'https://picsum.photos/500/250?random=6',
                    'https://picsum.photos/500/250?random=7',
                    'https://picsum.photos/500/250?random=5',
                    'https://picsum.photos/500/250?random=6',
                    'https://picsum.photos/500/250?random=7',
                    'https://picsum.photos/500/250?random=8',
                    'https://picsum.photos/500/250?random=9',
                    'https://picsum.photos/500/250?random=10',
                ];

                $imageUrl = $imagePatterns[array_rand($imagePatterns)];

                DB::table('news_translations')->insert([
                    'news_id' => $news_id,
                    'language_id' => $language['language_id'],
                    'title' => $language['faker']->realText(50),
                    'description' => $language['faker']->realText(200),
                    'image_url' => $imageUrl,
                    'content' => $language['faker']->realText(2000),
                    'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-3 months', 'now'),
                ]);
            }
        }
    }
}
