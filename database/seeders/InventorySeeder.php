<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    public function run(){
        $inventory = json_decode(file_get_contents(__DIR__."/data.json"),true)["inventory"];
        foreach($inventory as $item){
            $amount = filter_var($item["amount"], FILTER_SANITIZE_NUMBER_INT);
            $unit = preg_replace('/[0-9\s]/', '', $item["amount"]);

            DB::table("inventory")->insert([
                'name' => $item["name"],
                'amount' => convert_to_base_unit($amount, $unit),
                'unit' => 'base',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
