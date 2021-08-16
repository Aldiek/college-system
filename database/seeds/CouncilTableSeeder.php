<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class  CouncilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('councils')->insert([
            'name' => 'مجلس جامعة تشرين',
            'councilable_id' => 1,
            'councilable_type' =>'App\Models\UniversityCouncil' ,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('councils')->insert([
            'name' => 'مجلس الشؤون العلمية',
            'councilable_id' => 1,
            'councilable_type' =>'App\Models\ScientificAffairsCouncil' ,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('councils')->insert([
            'name' => 'مجلس البحث العلمي',
            'councilable_id' => 1,
            'councilable_type' =>'App\Models\ScientificResearchesCouncil' ,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
