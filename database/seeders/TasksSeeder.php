<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Task;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::factory()->count(10)->create();
        // DB::table('tasks')->insert([
        //     'title' => Str::random(20),
        //     'content' => Str::random(50),
        //     'user_id' => '1',
        //     'status' => '1',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
