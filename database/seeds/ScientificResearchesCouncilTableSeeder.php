<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ScientificResearchesCouncilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scientific_researches_councils')->insert([
            'name' => 'مجلس البحث العلمي',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
