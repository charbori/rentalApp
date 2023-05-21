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
        return view('birdmap', compact('viewEnv'));
    }

    public function show(Request $request) {
		$mymap = \App\Models\MapList::with('user')->get();
		$mymapattach = \App\Models\MapAttachment::get();
		$marker_data = array();

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

        return $marker_data;
    }

}
