<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('centers')->insert([
            'name' => 'Admin',
            'description' => 'Squarely admin center',
            'location' => 'Dubai, UAE',
        ]);
    }
}
