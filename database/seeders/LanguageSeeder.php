<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['code' => 'en', 'name' => 'English', 'iso' => 'en_US', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ja', 'name' => '日本語', 'iso' => 'ja_JP', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ru', 'name' => 'Русский', 'iso' => 'ru_RU', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'zh', 'name' => '中文', 'iso' => 'zh_TW', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
