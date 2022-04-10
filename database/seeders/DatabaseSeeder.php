<?php

namespace Database\Seeders;

use App\Models\DynamicNeed;
use App\Models\Gadget;
use App\Models\StaticNeed;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Gadget::factory(10)->create();
        StaticNeed::factory(30)->create();
        DynamicNeed::factory(30)->create();
    }
}
