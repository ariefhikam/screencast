<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;
use Image;
use Auth;
class ImageController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth',['only'=>['video']]);
    }

    public function image($storage,$image,Request $request){
        $file = Storage::disk('local')->get(config('sites.stored_image_'.$storage).$image);
        
        $image = Image::make($file);
        //dd($request->w);
        if(isset($request->w) && isset($request->h)){
        	//echo "asas";
          	$image->resize($request->w,$request->h);
        }
        return $image->response();
    }

    public function video($video,$series){
        //if (file_exists($filePath = config('sites.stored_video_lessons').$series."/".$video)) {
            $file = Storage::disk('local')->url("app/".config('sites.stored_video_lessons').$series."/".$video);
            //dd($file);
            $stream = new \App\Http\VideoStream(base_path($file));
            return response()->stream(function() use ($stream) {
                $stream->start();
            });
        //}
    //return response("File doesn't exists", 404);
    }
}
