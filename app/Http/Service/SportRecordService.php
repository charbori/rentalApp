<?php

namespace App\Http\Service;

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
}
