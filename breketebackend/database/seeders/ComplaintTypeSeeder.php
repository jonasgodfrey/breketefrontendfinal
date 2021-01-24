<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaint_types')->insert([
            [
                "name" => "Pension",
            ],
            [
                "name" => "Medical Assistance",            
            ],
            [
                "name" => "Violation of human rights(women abuse)", 
            ],
           
        ]);
    }
}
