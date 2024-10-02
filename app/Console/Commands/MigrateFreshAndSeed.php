<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateFreshAndSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mfs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migrate: fresh and seed the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        //$this->call('migrate:fresh --seed');
        //$this->call('db:seed --class=UserSeeder');
        $this->info('Database migrated and seeded successfully!');
    }
}
