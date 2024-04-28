<?php

namespace Database\Seeders;

use App\Models\Proyect;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class taskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyects = Proyect::all();

        foreach ($proyects as $key => $value) {
            Task::factory()->for($value)->create();
            Task::factory()->for($value)->create();
            Task::factory()->for($value)->create();
            Task::factory()->for($value)->create();
        }
    }
}
