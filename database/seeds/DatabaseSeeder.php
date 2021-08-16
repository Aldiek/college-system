<?php

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
        $this->call(
            [
                UsersTableSeeder::class,
                ScientificAffairsCouncilTableSeeder::class,
                ScientificResearchesCouncilTableSeeder::class,
                UniversityCouncilTableSeeder::class,
                CouncilTableSeeder::class
                ]
        );
    }
}
