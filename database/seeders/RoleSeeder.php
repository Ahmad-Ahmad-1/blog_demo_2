<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo('Create Post');
        $role->givePermissionTo('Edit Post');
        $role->givePermissionTo('Delete Post');
    }
}
