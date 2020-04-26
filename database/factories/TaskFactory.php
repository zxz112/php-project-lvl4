<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $newId = \App\TaskStatus::where('name', 'new')->first()->id;
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'task_status_id' => $newId,
        'created_by_id' => 1, // password
        'assigned_to_id' => 2,
    ];
});
