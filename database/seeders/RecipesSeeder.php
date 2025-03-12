<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesSeeder extends Seeder
{
    public function run(){
        $recipes = json_decode(file_get_contents(__DIR__."/data.json"),true)["recipes"];
        foreach($recipes as $recipe){
            DB::table('recipes')->insert([
                'name' => $recipe['name'],
                'price' => str_replace('Ft','',$recipe['price']),
                'lactose_free' => $recipe['lactoseFree'],
                'gluten_free' => $recipe['glutenFree'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
