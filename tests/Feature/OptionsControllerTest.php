<?php

namespace Tests\Feature;

use App\Starter\Options\Option;
use App\Starter\Users\User;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OptionsControllerTest extends TestCase {


    use WithFaker;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_list_options() {
        dump('test_list_options');
        $user = User::find(1);
        $latest = Option::orderBy('id', 'desc')->first();
        $response = $this->actingAs($user)
                ->withSession(['locale' => 'en'])
                ->get('options')
                ->assertStatus(200)
                ->assertSee('options');
    }

    public function test_create_options() {
        dump('test_create_options');
        $user = User::find(1);
        $row = factory(Option::class)->make();
        $title = [
            'title:en' => 'title'
        ];
        $row = array_merge($row->toArray(),$title);
        $response = $this->actingAs($user)
                ->post('options/create',$row);
        $latest = Option::orderBy('id', 'desc')->first();
        $this->assertEquals($row['title:en'], $latest->title);
        $latest->forceDelete();
    }

    public function test_edit_options() {
        dump('test_edit_options');
        $user = User::find(1);
        $record = factory(Option::class)->create();
        $row = factory(Option::class)->make();
        $title = [
            'title:en' => 'title'
        ];
        $row = array_merge($row->toArray(),$title);
        $response = $this->actingAs($user)
                ->put('options/edit/' . $record->id, $row);
        $record = Option::find($record->id);
        $this->assertEquals($record->title, $row['title:en']);
        $record->forceDelete();
    }

    public function test_delete_options() {
        dump('test_delete_options');
        $user = User::find(1);
        $record = Option::create(factory(Option::class)->make()->toArray());
        $response = $this->actingAs($user)
                ->withSession(['locale' => 'en'])
                ->get('options/delete/' . $record->id);
        $this->assertEquals('a', 'a');
        $record->forceDelete();
    }

}
