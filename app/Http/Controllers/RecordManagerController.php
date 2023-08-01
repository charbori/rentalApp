<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Service\SportRecordService;
use Jenssegers\Agent\Agent;

class RecordManagerController extends Controller
{

    public function view(Request $request) {
        $agent = new Agent();
        $sport_category = empty($request->sport_category) ? 'player' : 'team';
	    $view_env = array('agent' => 'pc');
        $view_name = 'recordList';

        if ($agent->isMobile()) {
            $view_name = 'mo.recordList';
            $view_env['agent'] = 'mobile';
        }

        $view_map_id = (strlen($request->map_id) == 0) ? '27' : $request->map_id;

        $get_map_data = \App\Models\MapList::where('id', $request->map_id)->get();
        if (count($get_map_data) == 0) {
            flash('기록 조회에 실패하였습니다.');
            return back();
        }

        return view($view_name, compact('sport_category', 'view_env', 'view_map_id', 'get_map_data'));
    }

    public function mypage(Request $request) {
        $agent = new Agent();
	    $view_env = array('agent' => 'pc');
        $view_name = 'mypage.myrecord';

        if ($agent->isMobile()) {
            $view_name = 'mypage.myrecord_mo';
            $view_env['agent'] = 'mobile';
        }

        return view($view_name, compact('view_env'));
    }

    public function show(Request $request) {
        if (empty($request->map_id)) $map_id = 27;
        else $map_id = $request->map_id;
        if (empty($request->year)) $year = 2023;
        else $year = $request->year;
        if (empty($request->month_type) || $request->month_type == 'first_half') $diffTime = "<";
        else $diffTime = ">=";
        if (empty($request->page)) $skip = 0;
        else $skip = ($request->page - 1) * 10;
        if (empty($request->sport_code) || $request->sport_code == 'short_lane') $sport_code = array('50', '100');
        else if ($request->sport_code == 'middle_lane') $sport_code = array('200', '400');
        else if ($request->sport_code == 'long_lane') $sport_code = array('800', '1500');

        $data = array(  'map_id'        => $map_id,
                        'year'          => $year,
                        'month_type'    => $diffTime,
                        'skip'          => $skip,
                        'sport_code'    => $sport_code,
                        'search_name'   => $request->search_name);

        if (isset($request->search_name)) {
            $user = \App\Models\User::where('name', $request->search_name)->limit(1)->get();
            $data['user'] = $user;
        }
        if (isset($request->group_id)) {
            $user = \App\Models\User::where('group_id', $request->group_id)->get();
            $data['user'] = $user;
        } else if ($request->sport_category == 'team') {
            $user = \App\Models\User::where('group_id', '!=', '0')->get();
            $data['user'] = $user;
        }

        $sportService = new SportRecordService();

        if ($request->sport_category == 'team') {
            $result = $sportService->getTeamRecord($data);
            $sport_category = 'team';
        } else {
            $result = $sportService->getUserRecord($data);
            $sport_category = 'player';
        }

		$param = array('data' => array(), 'data2' => array(), 'count' => 0, 'count2' => 0, 'sport_category' => $sport_category);

        foreach ($result['res'] AS $val) {
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

        foreach ($result['res2'] AS $val2) {
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

        $param['count'] = $result['res_count'];
        $param['count2'] = $result['res2_count'];

        return $param;
    }

    public function getUserRecordMypage(Request $request) {

        $sportService = new SportRecordService();

        $user_data = array();
        $user_data[] = Auth::user();
        $data = array(  'user'  => $user_data,
                        'skip'  => '0');
        $result = $sportService->getUserMapList($data);

        return $result;
    }

    public function getRecordRanking(Request $request) {
        $sportService = new SportRecordService();

        $result = $sportService->getRankingList();

        return $result;
    }

    public function userRecentRecord(Request $request) {
        if (empty($request->year)) $year = 2023;
        else $year = $request->year;

        $data = array(  'map_id'        => $map_id,
                        'year'          => $year,
                        'month_type'    => $diffTime,
                        'skip'          => $skip,
                        'sport_code'    => $sport_code,
                        'search_name'   => $request->search_name);

        $sportService = new SportRecordService();

        $result = $sportService->getUserRecord($data);

        foreach ($result['res'] AS $val) {
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

        foreach ($result['res2'] AS $val2) {
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

        $param['count'] = $result['res_count'];
        $param['count2'] = $result['res2_count'];

        return $param;
    }
}
