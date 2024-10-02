<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Language;

class CreateTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $languages = Language::all();

        for ($i = 0; $i < 10; $i++) {
            $tag_id = DB::table('tags')->insertGetId([
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($languages as $language) {
                $faker = Faker::create($language->iso);

                DB::table('tags_translations')->insert([
                    'tag_id' => $tag_id,
                    'language_id' => $language->id,
                    'title' => $faker->unique()->realText(20),
                    'description' => $faker->realText($maxNbChars = 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        };

        //DB::table('tags')->insert([
        //['name' => 'Sales', 'created_at' => now(), 'updated_at' => now()],
        //['name' => 'Updates', 'created_at' => now(), 'updated_at' => now()],
        //['name' => 'Live', 'created_at' => now(), 'updated_at' => now()],
        //['name' => 'Classic', 'created_at' => now(), 'updated_at' => now()],
        //['name' => 'Events', 'created_at' => now(), 'updated_at' => now()],
        //);
    }
}
