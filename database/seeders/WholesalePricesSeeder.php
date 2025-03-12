<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WholesalePricesSeeder extends Seeder
{
    public function run(){
        $prices = json_decode(file_get_contents(__DIR__."/data.json"),true)['wholesalePrices'];

        foreach($prices as $price){
            $amount = filter_var($price['amount'], FILTER_SANITIZE_NUMBER_INT);
            $unit = preg_replace('/[0-9\s]/', '', $price['amount']);

            DB::table('wholesale_prices')->insert([
                'name' => $price['name'],
                'amount' => convert_to_base_unit($amount, $unit),
                'unit' => 'base',
                'price' => $price['price'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
//        $data = [
//            ['name' => 'flour', 'amount' => 10, 'unit' => 'kg', 'price' => 1500],
//            ['name' => 'gluten-free flour', 'amount' => 10, 'unit' => 'kg', 'price' => 3000],
//            ['name' => 'egg', 'amount' => 12, 'unit' => 'pc', 'price' => 240],
//            ['name' => 'sugar', 'amount' => 10, 'unit' => 'kg', 'price' => 1200],
//            ['name' => 'milk', 'amount' => 10, 'unit' => 'l', 'price' => 2000],
//            ['name' => 'soy-milk', 'amount' => 10, 'unit' => 'l', 'price' => 4000],
//            ['name' => 'butter', 'amount' => 1, 'unit' => 'kg', 'price' => 2000],
//            ['name' => 'vanilin sugar', 'amount' => 1, 'unit' => 'kg', 'price' => 3000],
//            ['name' => 'fruit', 'amount' => 10, 'unit' => 'kg', 'price' => 2000],
//            ['name' => 'chocolate', 'amount' => 10, 'unit' => 'kg', 'price' => 2000],
//        ];
//
//        foreach($data as $item){
//            DB::table('wholesale_prices')->insert([
//                'name' => $item['name'],
//                'amount' => convert_to_base_unit($item['amount'], $item['unit']),
//                'unit' => 'base',
//                'price' => $item['price'],
//                'created_at' => now(),
//                'updated_at' => now()
//            ]);
//        }
    }
}
