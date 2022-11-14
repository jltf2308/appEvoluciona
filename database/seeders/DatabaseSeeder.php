<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompetenceSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(QuestionSeeder::class);

    }
}
