<?php

namespace Tests\Feature;

use App\Starter\Users\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_list_users()
    {
        dump('test_list_users');
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->get('users')
            ->assertStatus(200)
            ->assertSee('users');
    }

    public function test_create_users()
    {
        dump('test_create_users');
        $user = User::find(1);
        $row = factory(User::class)->make();
        $response = $this->actingAs($user)
            ->post('users/create', $row->toArray());
        $latest = User::orderBy('id', 'desc')->first();
        $this->assertEquals($row->title, $latest->title);
        $latest->forceDelete();
        $response->assertStatus(302);
    }
//
    public function test_edit_users()
    {
        dump('test_edit_users');
        $user = User::find(1);
        $record = User::create(factory(User::class)->make()->toArray());
        $row = factory(User::class)->make();
//        dd($row->toArray());
        $response = $this->actingAs($user)
            ->put('users/edit/' . $record->id, $row->toArray());
        $record = User::find($record->id);
        $this->assertEquals($record->title, $row->title);
        $record->forceDelete();
        $response->assertStatus(302);
    }

    public function test_delete_users()
    {
        dump('test_delete_users');
        $user = User::find(1);
        $record = User::create(factory(User::class)->make()->toArray());
        $response = $this->actingAs($user)
            ->delete('users/delete/' . $record->id);
        $record->forceDelete();
        $response->assertStatus(302);
    }
}
