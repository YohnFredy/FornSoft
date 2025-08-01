<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(['name' => 'Superadmin']);
        $admin = Role::create(['name' => 'Admin']);

        /* Permission::create(['name' => 'admin.users.index'])->assignRole($superadmin); */
        Permission::create(['name' => 'admin.index'])->syncRoles([$superadmin, $admin]);

        $this->createUserPermissions([$superadmin, $admin]);
        $this->createCategoryPermissions([$superadmin, $admin]);
        $this->createProductsPermissions([$superadmin, $admin]);

        Permission::create(['name' => 'admin.factura'])->syncRoles([$superadmin, $admin]);
    }

    private function createUserPermissions($roles)
    {
        Permission::create(['name' => 'admin.users.index'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.create'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.show'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles($roles);
    }

    private function createCategoryPermissions($roles)
    {
        Permission::create(['name' => 'admin.categories.index'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.show'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles($roles);
    }

    private function createProductsPermissions($roles)
    {
        Permission::create(['name' => 'admin.products.index'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.create'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.show'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.edit'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.destroy'])->syncRoles($roles);
    }
}
