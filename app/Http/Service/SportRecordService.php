<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;

class SportRecordService
{
    public function __construct() {

    }

    public function getUserRecord($data) {
        if (isset($data['user'])) {
            $res = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][0])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->orderBy('record', 'asc')->offset($data['skip'])->limit(10)->get();
            $res_count = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('map_id', $data['map_id'])
            ->where('sport_code', $data['sport_code'][0])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")->count();
            $res2 = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][1])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->orderBy('record', 'asc')->offset($data['skip'])->limit(10)->get();
            $res2_count = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][1])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")->count();
        } else {
            $res = \App\Models\SportsRecord::with('user')->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->where('sport_code', $data['sport_code'][0])
            ->where('map_id', $data['map_id'])
            ->orderBy('record', 'asc')->offset($data['skip'])->limit(10)->get();
            $res_count = \App\Models\SportsRecord::with('user')->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->where('sport_code', $data['sport_code'][0])
            ->where('map_id', $data['map_id'])
            ->count();
            $res2 = \App\Models\SportsRecord::with('user')->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->where('sport_code', $data['sport_code'][1])
            ->where('map_id', $data['map_id'])
            ->orderBy('record', 'asc')->offset($data['skip'])->limit(10)->get();
            $res2_count = \App\Models\SportsRecord::with('user')->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->where('sport_code', $data['sport_code'][1])
            ->where('map_id', $data['map_id'])
            ->count();
        }

        return array('res'   => $res,
                    'res2'  => $res2,
                    'res_count' => $res_count,
                    'res2_count'=> $res2_count);
    }

    public function getTeamRecord($data) {
        if (isset($data['user']) && is_object($data['user'])) {
            $res = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][0])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->orderBy('record', 'asc')->offset($data['skip'])->limit(10)->get();
            $res_count = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][0])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")->count();
            $res2 = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][1])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")
            ->orderBy('record', 'asc')->offset($data['skip'])->limit(10)->get();
            $res2_count = \App\Models\SportsRecord::with('user')->where('user_id', $data['user'][0]->id)
            ->where('sport_code', $data['sport_code'][1])
            ->where('map_id', $data['map_id'])
            ->whereDate('created_at', $data['month_type'], $data['year']."-07-01")->count();
        } else {
            return array('res'   => array(),
                        'res2'  => array(),
                        'res_count' => array(),
                        'res2_count'=> array());
        }

        return array('res'   => $res,
                    'res2'  => $res2,
                    'res_count' => $res_count,
                    'res2_count'=> $res2_count);
    }

    public function getUserMapList($data) {
        if (isset($data['user'])) {
            $find_date = date('Y-m-d H:i:s',  time() - 15000000);
            $res =  DB::table('sports_record')->select(DB::raw('count(*) as cnt, map_id, title'))
                    ->join('map_list', 'sports_record.map_id', '=', 'map_list.id')
                    ->where('sports_record.user_id', $data['user'][0]->id)
                    ->where('sports_record.created_at', '>', $find_date)
                    ->orderBy('sports_record.map_id', 'desc')->groupBy('sports_record.map_id')->limit(3)->get();
        }

        return array('res' => $res);
    }
}
