<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateMaxProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:max-production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the maximum number of each product that can be produced from the current inventory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $recipes = DB::table('recipes')->get();
        $ingredients = DB::table('ingredients')->get()->groupBy('recipe_id');
        $inventory = DB::table('inventory')->pluck('amount', 'name');

        $result = [];
        foreach ($recipes as $recipe) {
            $recipeIngredients = $ingredients[$recipe->id] ?? [];
            $maxProducts = PHP_INT_MAX;

            foreach ($recipeIngredients as $recipeIngredient) {
                $inventoryAmount = $inventory[$recipeIngredient->name] ?? 0;
                $ingredientAmount = $recipeIngredient->amount;

                $maxByIngredient = $inventoryAmount / $ingredientAmount;

                if ($maxByIngredient < $maxProducts) {
                    $maxProducts = floor($maxByIngredient);
                }
            }
            $result[$recipe->name] = $maxProducts;
        }

        $this->info('Maximum number of each product that can be produced from the current inventory:');
        foreach ($result as $product => $max){
            $this->line(" $product: $max");
        }
    }
}
