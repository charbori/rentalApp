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

class RankingController extends Controller
{
    public function view(Request $request) {
        $viewName = "ranking.ranking";

        return view($viewName);
    }

    public function show(Request $request) {
		$res = \App\Models\SportsRecord::with('user')->get();
		$param = array();

        foreach ($res AS $val) {
            if (is_object($val)) {
                $param[] = array(
                    'id'            => $val->id,
                    'name'          => $val->title,
                    'type'          => 'swim',
                    'record'        => $val->record,
                    'map_id'        => $val->map_id,
                    'user_id'       => $val->user->name,
                    'reg_date'      => $val->created_at,
                );
            }
        }

        return $param;
    }

    public function edit(Request $request) {


    }

    public function store(Request $request) {

    }

}
