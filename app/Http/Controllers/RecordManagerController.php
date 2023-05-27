<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecordManagerController extends Controller
{

    public function view(Request $request) {
        return view('recordList');
    }

    public function show(Request $request) {
		$res = \App\Models\SportsRecord::with('user')->get();
		$param = array();

        Log::debug($res);

        foreach ($res AS $val) {
            if (is_object($val)) {
                $param[] = array(
                    'id'            => $val->id,
                    'type'          => 'swim',
                    'record'        => $val->record,
                    'user_id'       => $val->user->name,
                    'map_id'        => $val->map_id,
                    'reg_date'      => $val->created_at,
                );
            }
        }

        return $param;
    }

}
