<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();
        factory(\App\TaskStatus::class, 2)->make();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertRedirect();
    }


    public function testEdit()
    {
        $article = factory(\App\TaskStatus::class)->create();
        $response = $this->get(route('task_statuses.edit', $article->id));
        $response->assertRedirect();
    }

    public function testCreateAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEditAuth()
    {
        $user = factory(\App\User::class)->create();
        $status = factory(\App\TaskStatus::class)->create();
        $response = $this->actingAs($user)->get(route('task_statuses.edit', [$status->id]));
        $response->assertOk();
    }

    public function testStore()
    {
        $user = factory(\App\User::class)->create();
        $factoryData = factory(\App\TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->actingAs($user)->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $user = factory(\App\User::class)->create();
        $status = factory(\App\TaskStatus::class)->create();
        $factoryData = factory(\App\TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->actingAs($user)->patch(route('task_statuses.update', $status->id), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $user = factory(\App\User::class)->create();
        $status = factory(\App\TaskStatus::class)->create();
        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', $status->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }
}
