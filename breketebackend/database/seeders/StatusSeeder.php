<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('status')->insert([
            [
                "name" => "online", 'description' => 'user is online',
            ],
            [
                "name" => "offline", 'description' => 'user is offline',
            ],
            [
                "name" => "suspended", 'description' => 'suspended account',
            ],
        ]);
    }
}
