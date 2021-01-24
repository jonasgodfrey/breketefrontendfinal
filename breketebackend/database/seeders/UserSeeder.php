<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $superadminRole = Role::where('name', 'SuperAdmin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $complantAttendantRole = Role::where('name', 'ComplaintAttendant')->first();
        $resolutionAttendantRole = Role::where('name', 'ResolutionAttendant')->first();

        $superadmin = User::create([
            'name' => 'SuperAdmin user',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('superadminpassword'),
            'status_id' => '1',
        ]);
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('adminpassword'),
            'status_id' => '2',
        ]);
        $complantattendant = User::create([
            'name' => 'Complant Attendant',
            'email' => 'complantattendant@mail.com',
            'password' => Hash::make('password'),
            'status_id' => '2',
         ]);
        $resolutionattendant = User::create([
            'name' => 'Resolution Attendant',
            'email' => 'resolutionattendant@mail.com',
            'password' => Hash::make('password'),
            'status_id' => '2',
        ]);

        $superadmin->roles()->attach($superadminRole);
        $admin->roles()->attach($adminRole);
        $complantattendant->roles()->attach($complantAttendantRole);
        $resolutionattendant->roles()->attach($resolutionAttendantRole);
    }
}
