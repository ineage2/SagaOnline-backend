<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'Sales', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Updates', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Live', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Classic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Events', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
