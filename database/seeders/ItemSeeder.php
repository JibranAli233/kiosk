<?php

namespace Database\Seeders;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Item-one',
            'Item-two',
            'Item-three'
         ];
         foreach ($data as $key => $val) {
            $price = 100 * ($key+1);
            Item::create([
                            'name'   => $val,
                            // 'unit_id'   => 1,
                            // 'tot_piece' => 1,
                            // 'free_piece'    => 1,
                            'purchase_price'    => $price ,
                            'sell_price'    => ($price + 100),
                            // 'unit_sell_price'   => 1,
                            // 'company_percentage'    => 1,
                            // 'to_percentage' => 1,
                            
                            'manufacturer_id'   => 1,
                            'category_id'   => 1,
                            // 'group_id'  => 1,
                            'company_id'    => 1,
                            'branch_id' => 1,
                    ]);
         }
     }
}
