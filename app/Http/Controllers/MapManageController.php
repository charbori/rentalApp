<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MapManageController extends Controller
{
    public function view(Request $request) {
	    $viewEnv = array();
        return view('recordMap', compact('viewEnv'));
    }

    public function show(Request $request) {
		$marker_data = array();

        Log::debug($request->long.  ' ' . $request->lat);
        Log::debug((float)$request->long.  ' ' . (float)$request->lat);

        if (empty($request->long) || empty($request->lat)) {
            $mymap = \App\Models\MapList::with('user')->get();
            $mymapattach = \App\Models\MapAttachment::get();
        } else {
            $mymap = \App\Models\MapList::with('user', 'sports_record')->whereBetween('latitude', [$request->lat - 0.01, $request->lat + 0.01])->whereBetween('longitude', [$request->long - 0.01, $request->long + 0.01])->get();
            $mymapattach = \App\Models\MapAttachment::get();
        }

        Log::debug($mymap);

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
                    'long'          => $val->longitude
                );
            }
        }
        //select m.id, count(m.user_id) from map_list as `m` join users as u on u.id = m.user_id group by m.id;

        Log::debug($marker_data);

        return $marker_data;
    }

}
