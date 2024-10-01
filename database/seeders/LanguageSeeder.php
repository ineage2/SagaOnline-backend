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
            ['code' => 'en', 'name' => 'English', 'iso' => 'en-US', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ja', 'name' => '日本語', 'iso' => 'ja-JP', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ru', 'name' => 'Русский', 'iso' => 'ru-RU', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'zh', 'name' => '中文', 'iso' => 'zh-CN', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        DB::table('languages')->whereIn('code', ['en', 'ja', 'ru', 'zh'])->delete();
    }
}
