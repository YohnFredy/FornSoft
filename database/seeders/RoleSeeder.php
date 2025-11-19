<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superadmin = Role::create(['name' => 'Superadmin']);
        $admin = Role::create(['name' => 'Admin']);

        /* Permission::create(['name' => 'admin.users.index'])->assignRole($superadmin); */
        Permission::create(['name' => 'admin.index', 'description' => 'ver panel administrativo'])->syncRoles([$superadmin, $admin]);

        $this->createUserPermissions([$superadmin, $admin]);
        $this->createCategoryPermissions([$superadmin, $admin]);
        $this->createBrandPermissions([$superadmin, $admin]);
        $this->createProductsPermissions([$superadmin, $admin]);
        $this->createBusinessPermissions([$superadmin, $admin]);
        $this->createPubManangerPermissions([$superadmin, $admin]);
        $this->createInvoicePermissions([$superadmin, $admin]);
        $this->createBusinessReportPermissions([$superadmin, $admin]);
        $this->createRolesPermissions([$superadmin]);
    }

    private function createUserPermissions($roles)
    {
        Permission::create(['name' => 'admin.users.index',   'description' => 'Ver lista de Usuarios'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.create',  'description' => 'Crear Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.show',    'description' => 'Mostrar Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.edit',    'description' => 'Editar Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.users.destroy', 'description' => 'Eliminar Usuario'])->syncRoles($roles);
    }

    private function createCategoryPermissions($roles)
    {
        Permission::create(['name' => 'admin.categories.index',   'description' => 'Ver lista de Categorías'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.create',  'description' => 'Crear Categoría'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.show',    'description' => 'Mostrar Categoría'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.edit',    'description' => 'Editar Categoría'])->syncRoles($roles);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar Categoría'])->syncRoles($roles);
    }

    private function createPubManangerPermissions($roles)
    {
        Permission::create(['name' => 'admin.pub-mananger.index',   'description' => 'Ver lista de  publicidad'])->syncRoles($roles);
        Permission::create(['name' => 'admin.pub-mananger.create',  'description' => 'Crear publicidad'])->syncRoles($roles);
        Permission::create(['name' => 'admin.pub-mananger.show',    'description' => 'Mostrar publicidad'])->syncRoles($roles);
        Permission::create(['name' => 'admin.pub-mananger.edit',    'description' => 'Editar publicidad'])->syncRoles($roles);
        Permission::create(['name' => 'admin.pub-mananger.destroy', 'description' => 'Eliminar publicidad'])->syncRoles($roles);
    }


    private function createBrandPermissions($roles)
    {
        Permission::create(['name' => 'admin.brands.index',   'description' => 'Ver lista de Marcas'])->syncRoles($roles);
        Permission::create(['name' => 'admin.brands.create',  'description' => 'Crear Marca'])->syncRoles($roles);
        Permission::create(['name' => 'admin.brands.show',    'description' => 'Mostrar Marca'])->syncRoles($roles);
        Permission::create(['name' => 'admin.brands.edit',    'description' => 'Editar Marca'])->syncRoles($roles);
        Permission::create(['name' => 'admin.brands.destroy', 'description' => 'Eliminar Marca'])->syncRoles($roles);
    }

    private function createProductsPermissions($roles)
    {
        Permission::create(['name' => 'admin.products.index',   'description' => 'Ver lista de Productos'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.create',  'description' => 'Crear Producto'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.show',    'description' => 'Mostrar Producto'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.edit',    'description' => 'Editar Producto'])->syncRoles($roles);
        Permission::create(['name' => 'admin.products.destroy', 'description' => 'Eliminar Producto'])->syncRoles($roles);
    }

    private function createBusinessPermissions($roles)
    {
        Permission::create(['name' => 'admin.businesses.index',   'description' => 'Ver lista de Negocios'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businesses.create',  'description' => 'Crear Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businesses.show',    'description' => 'Mostrar Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businesses.edit',    'description' => 'Editar Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businesses.destroy', 'description' => 'Eliminar Negocio'])->syncRoles($roles);
    }


    private function createInvoicePermissions($roles)
    {
        Permission::create(['name' => 'admin.invoices.index',   'description' => 'Ver lista de Factura Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.invoices.create',  'description' => 'Crea Factura Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.invoices.show',    'description' => 'Mostra Factura Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.invoices.edit',    'description' => 'Edita Factura Usuario'])->syncRoles($roles);
        Permission::create(['name' => 'admin.invoices.destroy', 'description' => 'Elimina Factura Usuario'])->syncRoles($roles);
    }

    private function createBusinessReportPermissions($roles)
    {
        Permission::create(['name' => 'admin.businessReports.index',   'description' => 'Ver lista de Factura Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businessReports.create',  'description' => 'Crea Factura Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businessReports.show',    'description' => 'Mostra Factura Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businessReports.edit',    'description' => 'Edita Factura Negocio'])->syncRoles($roles);
        Permission::create(['name' => 'admin.businessReports.destroy', 'description' => 'Elimina Factura Negocio'])->syncRoles($roles);
    }

    private function createRolesPermissions($roles)
    {
        // Roles
        Permission::create(['name' => 'admin.roles.index',   'description' => 'Ver lista de Roles'])->syncRoles($roles);
        Permission::create(['name' => 'admin.roles.create',  'description' => 'Crear Rol'])->syncRoles($roles);
        Permission::create(['name' => 'admin.roles.show',    'description' => 'Mostrar Rol'])->syncRoles($roles);
        Permission::create(['name' => 'admin.roles.edit',    'description' => 'Editar Rol'])->syncRoles($roles);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Eliminar Rol'])->syncRoles($roles);
    }
}
