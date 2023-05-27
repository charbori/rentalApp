<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;
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
        $sports_record = \App\Models\SportsRecord::create([
            "type" => $request->type,
            "record" => $request->record,
            "user_id" => $id,
            "map_id" => $request->map_id,
        ]);
        return true;
    }

    public function edit(Request $request) {

    }
}
?>
