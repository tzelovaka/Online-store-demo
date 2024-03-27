<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mark;
use App\Models\Version;
use App\Models\Generation;
use App\Models\Item;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$mark = Mark::factory(5)->create();
        //$version = Version::factory(40)->create();
        //$generation = Generation::factory(100)->create();
        //$item = Item::factory(200)->create();
        //dd($mark, $version, $generation, $item);
        // \App\Models\User::factory(10)->create();
        \App\Models\Post::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
