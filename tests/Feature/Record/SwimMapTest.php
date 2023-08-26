<?php

namespace Tests\Feature\Record;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SwimMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_swim_map_registered()
    {
        $response = $this->post('/api/map/mapStore', [
            "title" => "미진",
            "type" => 'swim',
            "desc" => "미진",
            "longitude" => 37.3333,
            "latitude" => 37.3333,
            "user_id" => 1,
            "attachment" => "Y",
            "rank" => "0",
            "address" => "",
            "player_count" => "0",
            "tag" => ""
        ]);

        $this->assertDatabaseHas('map_list', [
            "title" => "미진",
            "type" => 'swim',
            "desc" => "미진",
            "longitude" => 37.3333,
            "latitude" => 37.3333,
            "user_id" => 1,
            "attachment" => "Y",
            "rank" => "0",
            "address" => "",
            "player_count" => "0",
            "tag" => ""
        ]);
    }
}
