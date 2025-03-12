<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RecipesSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(SalesSeeder::class);
        $this->call([WholesalePricesSeeder::class]);
    }
}
