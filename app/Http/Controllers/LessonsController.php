<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Lessons;
use App\Series;
use App\sitesTrait;

use Auth;
use File;
use Storage;
class LessonsController extends Controller
{
    //
	use sitesTrait;

    public function __construct(){
        $this->middleware('auth',['except'=>['view','onWatching']]);
        //$this->middleware('role:admin');
    }

    public function index(){
        $table = Series::with(['lessons'=>function($q){
            $q->where('users_id',Auth::user()->id);
            $q->orderBy('created_at','ASC');
        }])->where('user_id',Auth::user()->id);

        if(!Auth::user()->hasRole('admin')){
            $table->where('user_id',Auth::user()->id);
        }
        
        $table = $table->paginate(15);

        return view('lessons.index')->with(['series'=>$table]);
    }

    public function create($slug,$series_id){

    	$series = Series::findOrFail($series_id);
        $lessons = Lessons::where('series_id',$series_id)->orderBy('created_at','ASC')->paginate(10);
    	return view('lessons.create')->with(['series'=>$series,'lessons'=>$lessons]);
    }

    public function store($series_id,Request $request){
    	$input = $request->all();

    	// $this->validate($request, [
	    //     'display_name' => 'required|max:20',
	    //     'description' => 'required|max:140',
	    //     'price' => 'required|max:140',
	    //     'video' => 'required|integer|mimes:mp4,avi,mpeg,wmv,mkv,3gp,flv',
	    // ]);

    	$series = Series::findOrFail($series_id);

    	if($request->file('video')!=''){
            $file = $request->file('video');

            //Tempatin Video di tempat yang rapih, berdasarkan seriesnya
            if (!File::isDirectory( base_path().'/storage/app/'. config('sites.stored_video_lessons').'/'.$series->permalink)){
            	Storage::makeDirectory(config('sites.stored_video_lessons').'/'.$series->permalink);
            	//echo "Directories Created";
            }

            $fileName = $this->permalink($input['display_name']).'-'.str_random(10). '.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put(config('sites.stored_video_lessons').'/'.$series->permalink.'/'.$fileName,  File::get($file));
            $input['url'] = $fileName;
            array_forget($input, 'video'); // delete video fron array input
        }
    	
        $input['permalink'] = $this->permalink($input['display_name']).'-'.str_random(5);
    	$input['users_id'] = Auth::user()->id;
    	$input['series_id'] = $series_id;
    	//dd($input);
        $table = new Lessons;
        $table->fill($input);
        $table->save();

        if(isset($input['tags'])){
            foreach ($input['tags'] as $tag) {
                $table->tag()->attach($tag);
            }
        }

        return redirect()->route('lessons::create',['slug'=>$series->permalink,'series_id'=>$series->id])->withSuccess("Lessons Added !!");
    }

    public function edit($id){
        $table = Lessons::with('tag')->findOrFail($id);
        $series = Series::findOrFail($table->series_id);
        $lessons = Lessons::where('series_id',$table->series_id)->orderBy('created_at','ASC')->paginate(10);
        return view('lessons.edit')->with(['series'=>$series,'lessons'=>$lessons,'table'=>$table]);
    }

    public function update(Request $request,$id){
        $input = $request->all();

        // $this->validate($request, [
        //     'display_name' => 'required|max:20',
        //     'description' => 'required|max:140',
        //     'price' => 'required|max:140',
        //     'video' => 'required|integer|mimes:mp4,avi,mpeg,wmv,mkv,3gp,flv',
        // ]);
        $table = Lessons::findOrFail($id);
        $series = Series::findOrFail($table->series_id);

        if($request->file('video')!=''){
            $file = $request->file('video');

            //Tempatin Video di tempat yang rapih, berdasarkan seriesnya
            if (!File::isDirectory( base_path().'/storage/app/'. config('sites.stored_video_lessons').'/'.$series->permalink)){
                Storage::makeDirectory(config('sites.stored_video_lessons').'/'.$series->permalink);
                //echo "Directories Created";
            }

            $fileName = $this->permalink($input['display_name']).'-'.str_random(10). '.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put(config('sites.stored_video_lessons').'/'.$series->permalink.'/'.$fileName,  File::get($file));
            $input['url'] = $fileName;
            array_forget($input, 'video'); // delete video fron array input
        }
        
        //$input['permalink'] = $this->permalink($input['display_name']).'-'.str_random(5);
        //$input['users_id'] = Auth::user()->id;
        //$input['series_id'] = $series_id;
        //dd($input);
        
        $table->fill($input);
        $table->save();

        if(isset($input['tags'])){
            $table->tag()->sync($input['tags']);
        }

        return redirect()->route('lessons::edit',['id'=>$table->id])->withSuccess("Lessons Updated !!");
    }

    public function destroy($id){
        $table = Lessons::findOrFail($id);
        $table->delete();
        //dd($table->series);
        return redirect()->route('lessons::create',['slug'=>$table->series->permalink,'series_id'=>$table->series->id])->withSuccess("Lessons Deleted !!");
    }


    public function view($slug,$id){
        $table = Lessons::with('series','tag','user.profile')->findOrFail($id);
        $category = \App\Category::all();

        $anotherLessons = Lessons::where('series_id',$table->series_id)->orderBy('created_at','ASC')->get();

        return view('lessons.view')->with(['table'=>$table,'anotherLessons'=>$anotherLessons,'category'=>$category]);
    }

    public function enrole($id){
        $table = Lessons::with(['series','roled'=>function($q){
            $q->paginate(10);
        }])->findOrFail($id);

        return view('lessons.enrole')->with(['table'=>$table]);
    }

    public function enroleStore(Request $request,$id){
        $table = Lessons::findOrFail($id);
        //dd($request->user);
        $table->roled()->attach($request->user);

        return redirect()->route('lessons::enrole',['id'=>$table->id])->withSuccess("Users Added");
    }

    public function enroleDestroy($id,$user_id){
        $table = Lessons::findOrFail($id);
        //dd($request->user);
        $table->roled()->detach($user_id);

        return redirect()->route('lessons::enrole',['id'=>$table->id])->withSuccess("Users Deleted");
    }

    public function onWatching($id){
        $table = Lessons::findOrFail($id);

        $table->watch = $table->watch + 1;

        $table->save();

        return response()->json(1);
    }
}
