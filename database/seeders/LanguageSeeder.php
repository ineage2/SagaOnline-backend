<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTime = Carbon::now();

        DB::table('languages')->insert([
            ['code' => 'en', 'name' => 'English', 'iso' => 'en_US', 'created_at' => $currentTime, 'updated_at' => $currentTime],
            ['code' => 'ja', 'name' => '日本語', 'iso' => 'ja_JP', 'created_at' => $currentTime, 'updated_at' => $currentTime],
            ['code' => 'ru', 'name' => 'Русский', 'iso' => 'ru_RU', 'created_at' => $currentTime, 'updated_at' => $currentTime],
            ['code' => 'zh', 'name' => '中文', 'iso' => 'zh_TW', 'created_at' => $currentTime, 'updated_at' => $currentTime],
        ]);
    }
}
