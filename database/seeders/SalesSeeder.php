<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    public function run(){
        $sales = json_decode(file_get_contents(__DIR__."/data.json"),true)["salesOfLastWeek"];
        foreach($sales as $sale){
            $recipeId = DB::table('recipes') -> where('name', $sale['name']) -> value('id');

            DB::table('sales')->insert([
                'recipe_id' => $recipeId,
                'amount' => $sale['amount'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
