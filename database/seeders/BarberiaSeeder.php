<?php

namespace Database\Seeders;

use App\Models\Barberia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarberiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barberia::factory()->count(10)->create();
    }
}
