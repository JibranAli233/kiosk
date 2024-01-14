<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [

            // 'company-list',
            // 'company-create',
            // 'company-edit',
            // 'company-delete',

            // 'branch-list',
            // 'branch-create',
            // 'branch-edit',
            // 'branch-delete',

            // 'store-list',
            // 'store-create',
            // 'store-edit',
            // 'store-delete',
            
            // 'permission-list',
            // 'permission-create',
            // 'permission-edit',
            // 'permission-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',


            // 'unit-list',
            // 'unit-create',
            // 'unit-edit',
            // 'unit-delete',

            'item-list',
            'item-create',
            'item-edit',
            'item-delete',

            'manufacturer-list',
            'manufacturer-create',
            'manufacturer-edit',
            'manufacturer-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            // 'customer-list',
            // 'customer-create',
            // 'customer-edit',
            // 'customer-delete',

            // 'customer_type-list',
            // 'customer_type-create',
            // 'customer_type-edit',
            // 'customer_type-delete',

      
            'purchase-list',
            'purchase-create',
            'purchase-edit',
            'purchase-delete',

            'sell-list',
            'sell-create',
            'sell-edit',
            'sell-delete',

            'report-list',
            'report-create',
            'report-edit',
            'report-delete',
            
            'profile-list',
            'profile-create',
            'profile-edit',
            'profile-delete',

            'stock-list',
            'stock-create',
            'stock-edit',
            'stock-delete',
            
         ];
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
     }
}
