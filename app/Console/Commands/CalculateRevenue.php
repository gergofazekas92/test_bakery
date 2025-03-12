<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateRevenue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:revenue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the total revenue from the last week sales';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $revenue = DB::table('sales')
            ->join('recipes', 'recipes.id', '=', 'sales.recipe_id')
            ->selectRaw('SUM(sales.amount * recipes.price) as total_revenue')
            ->value('total_revenue');

        $this->info("The total revenue from the last week sales {$revenue} Ft");
    }
}
