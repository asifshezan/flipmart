<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * // php artisan db:seed --class=SetupSeeder
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Admin', 'Admin', 'Editor', 'User'];
        foreach($roles as $role){
            Role::create(['name' => $role]);
        }
    }
}
