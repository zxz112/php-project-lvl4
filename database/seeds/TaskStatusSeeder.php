<?php

use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TaskStatus::class)->create(['name' => 'new']);
        factory(App\TaskStatus::class)->create(['name' => 'in progress']);
        factory(App\TaskStatus::class)->create(['name' => 'test']);
        factory(App\TaskStatus::class)->create(['name' => 'complete']);
    }
}
