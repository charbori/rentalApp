<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function getRankingList() {
        $now_year = date('Y');
        $now_month = date('m');
        if ((int) $now_month > 6) {
            $created_at_start = '2023-07-01 00:00:00';
            $created_at_end = '2023-12-31 23:59:59';
        } else {
            $created_at_start = '2023-01-01 00:00:00';
            $created_at_end = '2023-06-30 23:59:59';
        }
        $sport_code_arr = array('50', '100', '200', '400', '800', '1500');
        $sport_record_datas = array();
        foreach ($sport_code_arr AS $sport_code) {
            $sport_record_datas[$sport_code] = DB::table('sports_record')->select(DB::raw('count(sport_code) as cnt, user_id, name'))
                ->join('users', 'users.id', '=', 'sports_record.user_id')
                ->where('sports_record.created_at', '>', $created_at_start)
                ->where('sports_record.created_at', '<', $created_at_end)
                ->where('sport_code', '=', $sport_code)
                ->groupBy('user_id')->orderBy('cnt')->get();
                //Log::debug($sport_record_datas[$sport_code]);
        }

                /*
                select count(sport_code) as cnt, user_id
from sports_record
where created_at > '2023-07-01 00:00:00'
and created_at < '2023-12-31 23:59:59'
group by user_id;
                */

        $sport_user_result = array();
        $user_result = array();
        $sport_code = "";
        // sport code 별로 조회해서 계산해야한다.
        // 50m
        foreach ($sport_code_arr AS $sport_code) {
            $sport_datas = $sport_record_datas[$sport_code];
            if (is_object($sport_datas)) {
                foreach ($sport_datas AS $val) {
                    if (empty($sport_user_result[$val->user_id])) {
                        $sport_user_result[$val->user_id] = $val->cnt * (int) $sport_code;
                        $user_result[$val->user_id] = $val->name;
                    } else {
                        $sport_user_result[$val->user_id] += $val->cnt * (int) $sport_code;
                        $user_result[$val->user_id] = $val->name;
                    }
                }
            }
        }
        $datas = array();
        foreach ($sport_user_result AS $key => $val2) {
            $datas[] = array(   'user_id' => $key,
                                'distance' => $val2,
                                'name' => $user_result[$key]);
        }
        return array('res' => $datas);
    }
}
