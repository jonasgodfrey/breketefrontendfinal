<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate();

        Role::create([
            'name' => 'SuperAdmin',
            'description' =>
                'somebody who has access to all the administration features within a single site.',
        ]);
        Role::create([
            'name' => 'Admin',
            'description' =>
                'sombody who has access to most of the administrative features of the site',
        ]);
        Role::create([
            'name' => 'ComplaintAttendant',
            'description' =>
                'somebody who can Views awaiting complaints reviews complaints, declare complaints as Valid, Invalid or Flagged..',
        ]);
        
        Role::create([
            'name' => 'ResolutionAttendant',
            'description' => 'somebody who can Views Pending Complaints and Declare complaints as resolved.',
        ]);
    }
}
