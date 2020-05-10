<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();
        factory(\App\Label::class, 2)->make();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertStatus(403);
    }


    public function testEdit()
    {
        $label = factory(\App\Label::class)->create();
        $response = $this->get(route('labels.edit', $label));
        $response->assertStatus(403);
    }

    public function testCreateAuth()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEditAuth()
    {
        $user = factory(\App\User::class)->create();
        $label = factory(\App\Label::class)->create();
        $response = $this->actingAs($user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function testStore()
    {
        $user = factory(\App\User::class)->create();
        $factoryData = factory(\App\Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->actingAs($user)->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdate()
    {
        $user = factory(\App\User::class)->create();
        $label = factory(\App\Label::class)->create();
        $factoryData = factory(\App\Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->actingAs($user)->patch(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $user = factory(\App\User::class)->create();
        $label = factory(\App\Label::class)->create();
        $response = $this->actingAs($user)->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
