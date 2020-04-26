<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'task_status_id' => 73,
        'created_by_id' => 1, // password
        'assigned_to_id' => 2,
    ];
});
