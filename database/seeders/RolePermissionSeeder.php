<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $admin = Role::create(['name' => 'admin']);
        // $editor = Role::create(['name' => 'editor']);

        // $editArticles = Permission::create(['name' => 'edit articles']);
        // $deleteArticles = Permission::create(['name' => 'delete articles']);

        // $admin->givePermissionTo([$editArticles, $deleteArticles]);
        // $editor->givePermissionTo($editArticles);
        $user = \App\Models\User::find(1);
        $user->assignRole('admin');
    }
}
