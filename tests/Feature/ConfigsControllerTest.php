<?php

namespace Tests\Feature;

use App\Starter\Config\Config;
use App\Starter\Users\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfigsControllerTest extends TestCase {

   

    public function test_edit_configs() {
        dump('test_edit_configs');
        $user = User::find(2);
        $record = Config::create(factory(Config::class)->make()->toArray());
        $row = factory(Config::class)->make();
        $response = $this->actingAs($user)
                ->withSession(['locale' => 'en'])
                ->post('configs/edit/' . $record->id, $row->toArray());
        $record = Config::find($record->id);
        $this->assertEquals($record->title, $row->title);
        $record->forceDelete();
    }

}
