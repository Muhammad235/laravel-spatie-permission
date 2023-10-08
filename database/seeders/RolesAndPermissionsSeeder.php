<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
              // Reset cached roles and permissions
              app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

              $addUser = 'add user';
              $editUser = 'edit user';
              $deleteUser = 'delete user';
              $approveStore = 'approve store';
              $suspendStore = 'suspend store';

              $addStore = 'add store';
              $editStore = 'edit store';
              $deleteStore = 'delete store';

              $addProductLine = 'add productline';
              $editProductLine = 'edit productline';
              $deleteProductLine = 'delete productline';

              $addBrand = 'add brand';
              $editBrand = 'edit brand';
              $deleteBrand = 'delete brand';

              $addProduct = 'add product';
              $editProduct = 'edit product';
              $deleteProduct = 'delete product';
              $viewProduct = 'view product';

              // create permissions for stores
              Permission::create(['name' => $addUser]);
              Permission::create(['name' => $deleteUser]);
              Permission::create(['name' => $editUser]);

              //store approval permissions
              Permission::create(['name' => $approveStore]);
              Permission::create(['name' => $suspendStore]);

              //manage store permissions
              Permission::create(['name' => $addStore]);
              Permission::create(['name' => $editStore]);
              Permission::create(['name' => $deleteStore]);

              //manage store brands
              Permission::create(['name' => $addBrand]);
              Permission::create(['name' => $editBrand]);
              Permission::create(['name' => $deleteBrand]);


              //manage productline permissions
              Permission::create(['name' => $addProductLine]);
              Permission::create(['name' => $editProductLine]);
              Permission::create(['name' => $deleteProductLine]);

              //manage product permissions
              Permission::create(['name' => $addProduct]);
              Permission::create(['name' => $editProduct]);
              Permission::create(['name' => $deleteProduct]);
              Permission::create(['name' => $viewProduct]);



              //define roles available
              $superAdmin = 'super-admin';
              $systemAdmin = 'system-admin';
              $storeOwner = 'store-owner';
              $storeAdmin = 'store-admin';
              $customer = 'customer';


              Role::create(['name' => $superAdmin])->givePermissionTo(Permission::all());

              Role::create(['name' => $systemAdmin])
            ->givePermissionTo([
                $addUser,
                $editUser,
                $deleteUser,
                $addStore,
                $editStore,
                $deleteStore,
                $approveStore,
                $suspendStore,
            ]);

            Role::create(['name' => $storeOwner])
            ->givePermissionTo([
                $addStore,
                $editStore,
                $deleteStore,
                $addBrand,
                $editBrand,
                $deleteBrand,
                $addProductLine,
                $editProductLine,
                $deleteProductLine,
                $addProduct,
                $editProduct,
                $deleteProduct,
            ]);

            Role::create(['name' => $storeAdmin])
            ->givePermissionTo([
                $addStore,
                $editStore,
                $deleteStore,
                $editBrand,
                $deleteProductLine,
                $addProduct,
                $editProduct,
                $deleteProduct,
            ]);

            Role::create(['name' => $customer])
            ->givePermissionTo([
                $viewProduct
            ]);

    }
}
