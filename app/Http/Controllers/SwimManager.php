<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\MapManagerInterface;

class SwimManager implements MapManagerInterface
{
    function __construct() {

    }

    public function view() {

    }

    public function store(Request $request) {
        if (Auth::check() === false) {
            return false;
        }
        $id = Auth::id();
        $sport_code = (empty($request->sport_code)) ? "50" : $request->sport_code;

        $sports_record = \App\Models\SportsRecord::create([
            "type" => $request->type,
            "record" => $request->record,
            "user_id" => $id,
            "map_id" => $request->map_id,
            "sport_code" => (string) $sport_code
        ]);

        return true;
    }

    public function edit(Request $request) {

    }
}
?>
