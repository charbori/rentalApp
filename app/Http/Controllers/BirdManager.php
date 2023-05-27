<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;
use App\Http\Controllers\MapManagerInterface;

class BirdManager implements MapManagerInterface
{
    function __construct() {

    }

    public function view() {

    }

    public function store(Request $request) {
        if (Auth::check() === false) {
            return false;
        }
        $id = Auth::id();
        $map_list = \App\Models\MapList::create([
            "title" => $request->title,
            "type" => $request->type,
            "desc" => $request->desc,
            "longitude" => $request->longitude,
            "latitude" => $request->latitude,
            "user_id" => $id,
            "attachment" => "Y"
        ]);
        $photos = $request->file('photos');
        $allowedfileExtension=['pdf','jpg','png','jpeg', 'docx','svg','gif'];

        foreach ($photos as $photo) {
            if ($photo->isValid()) {
                $filename = $photo->getClientOriginalName();
                $extension = $photo->getClientOriginalExtension();
                $check = in_array($extension,$allowedfileExtension);

                Log::debug($photo->getClientOriginalName());
                Log::debug($photo->getClientOriginalExtension());

                if ($check) {
                    $filepath = $photo->store('public/photos/', 'local');
                    $map_attachment_id = DB::table('map_attachemnt')->insertGetId(
                        array(  'map_id'    => $map_list->id,
                                'path'      => $filepath
                    ));
                    Log::debug('mapid : ' . $map_list);
                    Log::debug('map attach id : ' . $map_attachment_id);
                    Log::debug('auto filepath : ' . $filepath);
                    \App\Models\MapList::where("id", $map_list->id)->update([
                        "attachment" => $map_attachment_id
                    ]);
                } else {
                    Log::debug("file 체크 에러 : " . $filename . " extension : " . $extension);
                }
            }
        }
        return true;
    }

    public function edit(Request $request) {

    }
}
?>
