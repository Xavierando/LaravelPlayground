<?php

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('auth user can retrive a list of services', function () {

    $user = User::Factory()->create();

    $service = Service::factory()->create();
    $response = $this
        ->actingAs($user)
        ->get(route('api.services.index'));

    $response
        ->assertStatus(200)
        ->assertJsonPath('data.0.id', $service->id)
        ->assertJsonPath('data.0.attributes.title', $service->title)
        ->assertJsonPath('data.0.attributes.price', $service->price)
        ->assertJsonPath('data.0.attributes.duration', $service->duration / 60);
});

test('auth user can show a service', function () {

    $user = User::Factory()->create();

    $service = Service::factory()->create();
    $response = $this
        ->actingAs($user)
        ->get(route('api.services.show', ['service' => $service->id]));

    $response
        ->assertStatus(200)
        ->assertJsonPath('data.id', $service->id)
        ->assertJsonPath('data.attributes.title', $service->title)
        ->assertJsonPath('data.attributes.price', $service->price)
        ->assertJsonPath('data.attributes.duration', $service->duration / 60);
});

test('admin user can create a new service', function () {

    $user = User::Factory()->create();
    $user->isAdmin = true;
    $user->save();

    $response = $this
        ->actingAs($user)
        ->postJson(route('api.services.store'), [
            'data' => [
                'attributes' => [
                    'title' => 'new service',
                    'description' => 'descrption of new service',
                    'price' => '10',
                    'duration' => 3600,
                ],
            ],
        ]);

    $response
        ->assertStatus(201)
        ->assertJsonPath('data.attributes.title', 'new service')
        ->assertJsonPath('data.attributes.description', 'descrption of new service')
        ->assertJsonPath('data.attributes.price', '10')
        ->assertJsonPath('data.attributes.duration', 60);
});

test('auth user can not create a new service', function () {

    $user = User::Factory()->create();

    $response = $this
        ->actingAs($user)
        ->postJson(route('api.services.store'), [
            'data' => [
                'attributes' => [
                    'title' => 'new service',
                    'description' => 'descrption of new service',
                    'price' => '10',
                    'duration' => 3600,
                ],
            ],
        ]);
    // var_dump($response->json());
    $response
        ->assertStatus(200)
        ->assertJsonPath('errors.status', 401)
        ->assertJsonPath('errors.message', 'Unauthorized');
});

test('auth user can not delete a service', function () {

    $user = User::Factory()->create();
    $service = Service::factory()->create();

    $id = $service->id;

    $response = $this
        ->actingAs($user)
        ->deleteJson(route('api.services.destroy', ['service' => $id]));

    $response
        ->assertStatus(200)
        ->assertJsonPath('errors.status', 401)
        ->assertJsonPath('errors.message', 'Unauthorized');
});

test('admin user can delete a service', function () {

    $user = User::Factory()->create();
    $user->isAdmin = true;
    $user->save();
    $service = Service::factory()->create();

    $id = $service->id;

    $response = $this
        ->actingAs($user)
        ->deleteJson(route('api.services.destroy', ['service' => $id]));

    $response
        ->assertStatus(200)
        ->assertJsonPath('status', 200)
        ->assertJsonPath('message', 'Service successfully deleted');

    $this->assertDatabaseMissing('services', [
        'id' => $id,
    ]);
});
