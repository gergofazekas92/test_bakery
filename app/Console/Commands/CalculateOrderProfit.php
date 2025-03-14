<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateOrderProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:order-profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the cost and profit for the given order quantities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = [
            'Francia krémes' => 300,
            'Rákóczi túrós' => 200,
            'Képviselőfánk' => 300,
            'Isler' => 100,
            'Tiramisu' => 150,
        ];
        $revenue = 0;
        $totalCost = 0;
        foreach ($orders as $productName => $amount) {

            $recipe = DB::table('recipes')->where('name', $productName)->first();
            $ingredients = DB::table('ingredients')->where('recipe_id', $recipe->id)->get();

            $revenue += $amount * $recipe->price;

            foreach ($ingredients as $ingredient) {
                $ingredientCost = DB::table('wholesale_prices')->where('name', $ingredient->name)->first();
                if (!$ingredientCost) {
                    $this->error("Ingredient not found: {$ingredient->name}");
                    continue;
                }
                $cost = $amount * $ingredient->amount / $ingredientCost->amount * $ingredientCost->price;
                $totalCost += $cost;
            }
        }
        $profit = $revenue - $totalCost;

        $this->info("Total cost of ingredients: {$totalCost} Ft");
        $this->info("Total revenue: {$revenue} Ft");
        $this->info("Total profit: {$profit} Ft");
    }
}
