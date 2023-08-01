<?php

namespace App\Http\Controllers;

use App\Http\Service\SportRecordService;
use Illuminate\Http\Request;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;

class MapManageController extends Controller
{
    public function view(Request $request) {
        $agent = new Agent();
	    $view_env = array('agent' => 'pc');
        $view_name = 'recordMap';
        $now_month_type = (int) date("m");
        $now_month_type = ($now_month_type > 6) ? 'last_half' : 'before_half';

        if ($agent->isMobile()) {
            $view_name = 'mo.recordHome';
            $view_env['agent'] = 'mobile';
        }

        if ($request->view_type == 'map') {
            $view_name = 'mo.recordMap';
        }

        $user_rank_map_list = array('title' => '',
        'map_id' => '');
        $view_map_id = 0;

        if (Auth::check()) {
            $service_param = array('user' => array());
            $service_param['user'][] = Auth::user();
            $sport_record_service = new SportRecordService();
            Log::debug($service_param);
            $user_rank_map_list = $sport_record_service->getUserMapList($service_param);
            Log::debug($user_rank_map_list);
            if (count($user_rank_map_list) > 0) {
                $user_rank_map_list = $user_rank_map_list['res'][0];
            }
        }

        return view($view_name, compact('view_env', 'now_month_type', 'user_rank_map_list', 'view_map_id'));
    }

    public function show(Request $request) {
		$marker_data = array();

        if (empty($request->long) || empty($request->lat)) {
            $mymap = \App\Models\MapList::with('user')->get();
            $mymapattach = \App\Models\MapAttachment::get();
        } else {
            $mymap = \App\Models\MapList::with('user', 'sports_record')->whereBetween('latitude', [$request->lat - 0.01, $request->lat + 0.01])->whereBetween('longitude', [$request->long - 0.01, $request->long + 0.01])->get();
            $mymapattach = \App\Models\MapAttachment::get();
        }

        foreach ($mymap as $key => $val) {
            if (is_object($val)) {
                $path_val = "";
                if (isset($mymapattach)) {
                    foreach ($mymapattach AS $val_path) {
                        if ($val_path->map_id == $val->id) {
                            $path_val = $val_path->path;
                        }
                    }
                }

                $marker_data[] = array(
                    'id'            => $val->id,
                    'name'          => $val->title,
                    'type'          => 'A01',
                    'description'   => $val->desc,
                    'user_id'       => $val->user->name,
                    'reg_date'      => $val->created_at,
                    'path'          => Storage::url($path_val),
                    'lat'           => $val->latitude,
                    'long'          => $val->longitude,
                    'player_cnt'    => $val->player_count,
                    'record_cnt'    => $val->rank
                );
            }
        }
        //select m.id, count(m.user_id) from map_list as `m` join users as u on u.id = m.user_id group by m.id;

        return $marker_data;
    }

}
