<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ScientificAffairsCouncilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scientific_affairs_councils')->insert([
            'name' => 'مجلس الشؤون العلمية',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
