<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    public function run(){
        $recipes = json_decode(file_get_contents(__DIR__."/data.json"),true)["recipes"];
        foreach($recipes as $recipe){
            $recipeID = DB::table('recipes')->where('name',$recipe['name'])->value('id');

            foreach($recipe['ingredients'] as $ingredient){
                $amount = filter_var($ingredient['amount'], FILTER_SANITIZE_NUMBER_INT);
                $unit = preg_replace('/[0-9\s]/', '', $ingredient['amount']);

                DB::table('ingredients')->insert([
                    'recipe_id' => $recipeID,
                    'name' => $ingredient['name'],
                    'amount' => convert_to_base_unit($amount, $unit),
                    'unit' => 'base',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

}
