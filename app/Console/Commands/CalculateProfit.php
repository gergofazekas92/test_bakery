<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the total profit for the last week';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $revenue = DB::table('sales')
            ->join('recipes', 'recipes.id', '=', 'sales.recipe_id')
            ->selectRaw('SUM(recipes.price * sales.amount) as revenue')
            ->value('revenue');

        $ingredientsCost = DB::table('sales')
           ->join('recipes', 'recipes.id', '=', 'sales.recipe_id')
           ->join('ingredients', 'recipes.id', '=', 'ingredients.recipe_id')
           ->join('wholesale_prices', 'ingredients.name', '=', 'wholesale_prices.name')
            ->selectRaw('SUM(sales.amount * ingredients.amount / wholesale_prices.amount * wholesale_prices.price) as total')
            ->value('total');

        $profit = $revenue - $ingredientsCost;

        $this->info("Last week profit: {$profit} Ft");
    }
}
