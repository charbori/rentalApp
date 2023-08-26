<?php

namespace Tests\Feature\Record;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecordTest extends TestCase
{
    use RefreshDatabase;

    public function test_record_registered()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => "test@example.com",
            'password' => 'password',
        ]);

        $response = $this->post('/api/record/store', [
            "type" => "swim",
            "record" => "33.3",
            "user_id" => 1,
            "map_id" => 1,
            "sport_code" => "50"
        ]);

        $this->assertDatabaseHas('sports_record', [
            "type" => "swim",
            "record" => "33.3",
            "user_id" => 1,
            "map_id" => 1,
            "sport_code" => "50"
        ]);
    }
}
