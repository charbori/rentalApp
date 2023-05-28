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
        $skip = ($request->page - 1) * 10;
		$res = \App\Models\SportsRecord::with('user')->orderBy('record', 'asc')->skip($skip)->limit(10)->get();
        $res_count = \App\Models\SportsRecord::with('user')->count();

		$param = array('data' => array(), 'count' => 0);

        Log::debug($res);
        Log::debug($request->page);

        foreach ($res AS $val) {
            if (is_object($val)) {
                $param['data'][] = array(
                    'id'            => $val->id,
                    'type'          => 'swim',
                    'record'        => $val->record,
                    'user_id'       => $val->user->name,
                    'map_id'        => $val->map_id,
                    'reg_date'      => $val->created_at,
                );
            }
        }
        $param['count'] = $res_count;

        return $param;
    }

}
