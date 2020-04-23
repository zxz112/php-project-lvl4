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
        DB::table('task_statuses')->insert([
            ['name' => 'new'],
            ['name' => 'in progress'],
            ['name' => 'test'],
            ['name' => 'complete']
        ]);
    }
}
