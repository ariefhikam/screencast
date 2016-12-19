<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;
use File;
use Auth;

use App\sitesTrait;
use App\Series;
class SeriesController extends Controller
{
    //
    use sitesTrait;

    public function __construct(){
        $this->middleware('auth',['except'=>['view']]);
        //$this->middleware('verifyUser', ['only' => ['edit','update','destroy']]);
    }

    public function index()
    {
    	$table = Series::orderBy('updated_at','DESC')->with('user');
        if(!Auth::user()->hasRole('admin')){
            $table->where('user_id',Auth::user()->id);
        }
        $table = $table->paginate(15);
    	return view('series.index')->with(['series'=>$table]);
    }

    public function create(){
    	return view('series.create');
    }

    public function edit($id){
    	$table = Series::findOrFail($id);

    	return view('series.edit')->with(['table'=>$table]);
    }

    public function store(Request $request){
    	$input = $request->all();

    	$this->validate($request, [
	        'display_name' => 'required|max:20',
	        'description' => 'required|max:140',
	        'picture' => 'required|mimes:jpeg,bmp,png,jpg',
	    ]);


    	if($request->file('picture')!=''){
            $file = $request->file('picture');
            $fileName = str_random(10). $this->permalink($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put(config('sites.stored_image_series').$fileName,  File::get($file));
            $input['image'] = $fileName;
            array_forget($input, 'picture'); // delete picture fron array input
        }
        $input['permalink'] = $this->permalink($input['display_name']).'-'.str_random(5);
        $input['user_id'] = Auth::user()->id;

        $table = new Series;
        $table->fill($input);
        $table->save();

        return redirect()->route('series::index')->withSuccess("Series Added !!");
    }

    public function update($id, Request $request){

    	$input = $request->all();

    	$this->validate($request, [
	        'display_name' => 'required|max:20',
	        'description' => 'required|max:140',
	        //'image' => 'required|mimes:jpeg,bmp,png,jpg',
	    ]);

	    if($request->file('picture')!=''){
            $file = $request->file('picture');
            $fileName = str_random(10). $this->permalink($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put(config('sites.stored_image_series').$fileName,  File::get($file));
            $input['image'] = $fileName;
            array_forget($input, 'picture'); // delete picture fron array input
        }
        //$input['permalink'] = $this->permalink($input['display_name']).'-'.str_random(5);
        $input['user_id'] = Auth::user()->id;

        $table = Series::findOrFail($id);
        $table->fill($input);
        $table->save();

         return redirect()->route('series::edit',['id'=>$table->id])->withSuccess("Series Saved !!");
    }

    public function destroy($id){

    	$table = Series::findOrFail($id);
    	$table->delete();

    	return redirect()->route('series::index')->withSuccess("Record Deleted !!");
    }

    public function view($slug,$id){
        $table = Series::with(['lessons'=>function($q){
            $q->orderBy('created_at','ASC');
        }])->findOrFail($id);

        return view('series.view')->with(['table'=>$table]);
    }
}
