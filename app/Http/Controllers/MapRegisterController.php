<?php

namespace App\Http\Controllers;

use Monolog\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BirdManager;

use App\Http\Controllers\SwimManager;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;

class MapRegisterController extends Controller
{
    public $mapType = "map"; // bird map

    public function view(Request $request) {
        $viewName = "";
        if (isset($request->mapType)) {
            $this->mapType = $request->mapType;
        }

        switch ($this->mapType) {
            case "map":
                $viewName = "maps.birdRegisterForm";
                break;
            case "swim":
                $viewName = "maps.swimRegisterForm";
                break;
        }

        if ($viewName == "") {
            Log::debug("viewName 미생성 이슈");
        }

        return view($viewName);
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

    //public function edit(\App\Models\Article $article, $id = '') {
    public function edit(Request $request) {
	    /*
        if (Auth::check() === false) {
            flash("로그인 후 이용가능합니다.");
            return redirect('home');
        }
        $data = array(  "title" => "",
                        "content" => "");
        $article = \App\Models\Article::findOr($id, function() {
            return view('articles.edit', ["title" => "",
                                        "content" => ""]);
        });
        $data["title"] = $article->title;
        $data["content"] = $article->content;
        return view('articles.edit', $data);
	    */
    }

    public function store(Request $request) {
        if ($request->type == "map") {
            $mapManager = new BirdManager();
        } else if ($request->type == "swim") {
            $mapManager = new SwimManager();
        }

        $result = $mapManager->store($request);

        if (false === $result) {
            flash('저장에 실패하였습니다.');
            return redirect('api/map');
        }

        flash('저장되었습니다.');
	    $viewEnv = array();
        return view('birdmap', compact('viewEnv'));
    }
}