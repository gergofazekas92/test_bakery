<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ListFreeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:free-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List gluten-free, lactose-free, and both gluten- and lactose-free products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $glutenFree=DB::table('recipes')
            ->where('gluten_free',true)
            ->select('name', 'price')
            ->get();
        $lactoseFree=DB::table('recipes')
            ->where('lactose_free',true)
            ->select('name', 'price')
            ->get();
        $bothFree=DB::table('recipes')
            ->where('gluten_free',true)
            ->where('lactose_free',true)
            ->select('name', 'price')
            ->get();

        $this->info('Glutenfree products list:');
        foreach ($glutenFree as $product) {
            $this->line("{$product->name} {$product->price} Ft");
        }
        $this->info('Lactosefree products list:');
        foreach ($lactoseFree as $product) {
            $this->line("{$product->name} {$product->price} Ft");
        }
        $this->info('Gluten and Lactosefree products list:');
        foreach ($bothFree as $product) {
            $this->line("{$product->name} {$product->price} Ft");
        }
    }
}
