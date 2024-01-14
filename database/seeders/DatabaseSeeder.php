<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // AccountTypeSeeder::class,
            // AccountGroupSeeder::class,
            // TransactionTypeSeeder::class,
            // TransactionStatusSeeder::class,
            // RegionSeeder::class,
            // TerritorySeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            // UnitSeeder::class,
            StatusSeeder::class,
            // GroupSeeder::class,
            CategorySeeder::class,
            ManufacturerSeeder::class,
            ItemSeeder::class,
            Customer_typeSeeder::class
            
        ]);
    }
}
