<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $user;

    public function setup(): void
    {
        parent::setup();
        factory(\App\User::class)->make();
        factory(\App\TaskStatus::class, 2)->make();
        factory(\App\Task::class, 2)->make();
    }


    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect();
    }

    public function testEdit()
    {
        $task = factory(\App\Task::class)->create();
        $response = $this->get(route('tasks.edit', $task));
        $response->assertRedirect();
    }

    public function testCreateAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get(route('tasks.create'));
        $response->assertOk();
    }

    // public function testEditAuth()
    // {
    //     $user = factory(\App\User::class)->create();
    //     $task = factory(\App\Task::class)->create();
    //     $response = $this->actingAs($user)->get(route('tasks.edit', $task));
    //     $response->assertOk();
    // }

    // public function testStore()
    // {
    //     $user = factory(\App\User::class)->create();
    //     $factoryData = factory(\App\Task::class)->make()->toArray();
    //     $response = $this->actingAs($user)->post(route('tasks.store'), $factoryData);
    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect();

    //     $this->assertDatabaseHas('tasks', $factoryData);
    // }

    // public function testUpdate()
    // {
    //     $user = factory(\App\User::class)->create();
    //     $task = factory(\App\Task::class)->create();
    //     $factoryData = factory(\App\Task::class)->make()->toArray();
    //     $response = $this->actingAs($user)->patch(route('task_statuses.update', $task), $factoryData);
    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect();

    //     $this->assertDatabaseHas('task_statuses', $factoryData);
    // }

    // public function testDestroy()
    // {
    //     $user = factory(\App\User::class)->create();
    //     $task = factory(\App\Task::class)->create();
    //     $response = $this->actingAs($user)->delete(route('task_statuses.destroy', $task));
    //     $response->assertSessionHasNoErrors();
    //     $response->assertRedirect();

    //     $this->assertDatabaseMissing('task_statuses', ['id' => $task->id]);
    // }
}
