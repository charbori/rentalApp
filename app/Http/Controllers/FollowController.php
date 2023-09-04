<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Service\SportRecordService;

class FollowController extends Controller
{
    //
    public function index() {
        return view('home');
    }

    public function view(Request $request) {
        $view = "sns.user_follower";
        $user_data = User::with("user_attachment")->where("id", $request->id)
                    ->first();

        $follow_cnt = DB::table('follow')
                            ->where('id', '=', $user_data['id'])
                            ->count('id');

        $follower_cnt = DB::table('follow')
                            ->where('follower', '=', $user_data['id'])
                            ->count('id');
        $badge_cnt = 0;

        $is_followed = DB::table('follow')
                            ->where('user_id', '=', Auth::user()->id)
                            ->where ('follower', '=', $request->id)
                            ->count('id');

        if (Auth::check()) {
            $service_param = array('user' => array());
            $service_param['user'][] = (object) $user_data;
            $sport_record_service = new SportRecordService();
            $result_user_rank_map_list = $sport_record_service->getUserMapList($service_param);

            $result_rank_infos = $sport_record_service->getFollowInfos();
            $result_rank_list = $result_rank_infos['swim'];
            $res_user_attach = DB::table('user_attachment')
                                    ->where("user_id", '=', $user_data['id'])
                                    ->get();
            if (count($res_user_attach) > 0 && strlen($res_user_attach[0]->path) > 0) {
                $my_user_attach = $res_user_attach[0]->path;
                $my_user_attach = (strpos($my_user_attach, "public") !== false) ?
                                    str_replace("public", "/storage", $my_user_attach) : $my_user_attach;
                $my_user_attach = $my_user_attach;
            }
        }

        $user_data['path'] = "/build/images/people_icon.png";
        if (strlen($user_data['user_attachment']->path) > 0) {
            $user_data['path'] = (strpos($user_data['user_attachment']->path, "public") !== false) ?
            str_replace("public", "/storage", $user_data['user_attachment']->path) : $user_data['path'];
        }

        return view($view, [
            'user_data' => $user_data,
            'my_user_attach' => $user_data['path'],
            'follow_cnt' => $follow_cnt,
            'follower_cnt' => $follower_cnt,
            'badge_cnt' => $badge_cnt,
            'result_rank_list' => $result_rank_list,
            'my_user_attach' => $my_user_attach,
            'is_followed' => $is_followed
        ]);
    }

    public function store(Request $request) {
        if ($request->type == 'follow') {
            $res = DB::table('follow')->insert([
                'user_id' => Auth::user()->id,
                'reg_date' => date('Y-m-d H:i:s'),
                'follower' => $request->user_id,
            ]);
        } else {
            $res = DB::table('follow')->where('user_id', Auth::user()->id)
            ->where('follower', $request->user_id)
            ->delete();
        }

        return $res;
    }
}
