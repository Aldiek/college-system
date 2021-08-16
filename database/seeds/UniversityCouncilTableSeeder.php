<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UniversityCouncilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unversity_councils')->insert([
            'name' => 'مجلس جامعة تشرين',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
