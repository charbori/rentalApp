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
        if (empty($request->year)) $year = 2023;
        else $year = $request->year;
        if (empty($request->month_type) || $request->month_type == 'first_half') $diffTime = "<";
        else $diffTime = ">=";
        if (empty($request->page)) $skip = 0;
        else $skip = ($request->page - 1) * 10;
        if (empty($request->sport_code) || $request->sport_code == 'short_lane') $sport_code = array('50', '100');
        else if ($request->sport_code == 'middle_lane') $sport_code = array('200', '400');
        else if ($request->sport_code == 'long_lane') $sport_code = array('800', '1500');
        if (isset($request->search_name)) {
            $user = \App\Models\User::where('name', $request->search_name)->limit(1)->get();
        }
        Log::debug($request->search_name . " " . $request->page);
        if (isset($user)) {
            $res = \App\Models\SportsRecord::with('user')->where('user_id', $user[0]->id)
            ->where('sport_code', $sport_code[0])
            ->whereDate('created_at', $diffTime, $year."-07-01")
            ->orderBy('record', 'asc')->offset($skip)->limit(10)->get();
            $res_count = \App\Models\SportsRecord::with('user')->where('user_id', $user[0]->id)
            ->where('sport_code', $sport_code[0])
            ->whereDate('created_at', $diffTime, $year."-07-01")->count();
            $res2 = \App\Models\SportsRecord::with('user')->where('user_id', $user[0]->id)
            ->where('sport_code', $sport_code[1])
            ->whereDate('created_at', $diffTime, $year."-07-01")
            ->orderBy('record', 'asc')->offset($skip)->limit(10)->get();
            $res2_count = \App\Models\SportsRecord::with('user')->where('user_id', $user[0]->id)
            ->where('sport_code', $sport_code[1])
            ->whereDate('created_at', $diffTime, $year."-07-01")->count();
        } else {
            $res = \App\Models\SportsRecord::with('user')->whereDate('created_at', $diffTime, $year."-07-01")
            ->where('sport_code', $sport_code[0])
            ->orderBy('record', 'asc')->offset($skip)->limit(10)->get();
            $res_count = \App\Models\SportsRecord::with('user')->whereDate('created_at', $diffTime, $year."-07-01")
            ->where('sport_code', $sport_code[0])
            ->count();
            $res2 = \App\Models\SportsRecord::with('user')->whereDate('created_at', $diffTime, $year."-07-01")
            ->where('sport_code', $sport_code[1])
            ->orderBy('record', 'asc')->offset($skip)->limit(10)->get();
            $res2_count = \App\Models\SportsRecord::with('user')->whereDate('created_at', $diffTime, $year."-07-01")
            ->where('sport_code', $sport_code[1])
            ->count();
        }

		$param = array('data' => array(), 'data2' => array(), 'count' => 0, 'count2' => 0);

        foreach ($res AS $val) {
            if (is_object($val)) {
                $param['data'][$val->sport_code][] = array(
                    'id'            => $val->id,
                    'type'          => 'swim',
                    'sport_code'    => $val->sport_code,
                    'record'        => (float) $val->record,
                    'user_id'       => $val->user->name,
                    'map_id'        => $val->map_id,
                    'reg_date'      => $val->created_at,
                );
            }
        }
        foreach ($res2 AS $val2) {
            if (is_object($val)) {
                $param['data2'][$val2->sport_code][] = array(
                    'id'            => $val2->id,
                    'type'          => 'swim',
                    'sport_code'    => $val2->sport_code,
                    'record'        => (float) $val2->record,
                    'user_id'       => $val2->user->name,
                    'map_id'        => $val2->map_id,
                    'reg_date'      => $val2->created_at,
                );
            }
        }
        $param['count'] = $res_count;
        $param['count2'] = $res2_count;

        Log::debug(print_r($param, true));
        Log::debug($request->page);

        return $param;
    }

}
