<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\sitesTrait;
use App\User;
use App\Profile;

use Auth;
use Storage;
use File;
class ProfileController extends Controller
{
    //
    use sitesTrait;
    public function view($name = null, $user_id = null){

    	if(!isset($user_id)){
    		$user_id = Auth::user()->id;
    	}

    	$table = Profile::with('user')->where('user_id',$user_id)->take(1)->first();
		//dd($table);
        return view('profile.view')->with(['table'=>$table]);
    }

    public function edit($id){
    	$table = Profile::findOrFail($id);

    	 return view('profile.edit')->with(['table'=>$table]);
    }

    public function update(Request $request,$id){
    	$input = $request->all();

    	if($request->file('image')!=''){
            $file = $request->file('image');
            $fileName = str_random(10). $this->permalink($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put(config('sites.stored_image_profile').$fileName,  File::get($file));
            array_forget($input, 'image'); // delete picture fron array input
            $input['image'] = $fileName;
        }
    	//dd($input);
    	$table = Profile::findOrFail($id);
        $table->fill($input);
        $table->save();

        return redirect()->route('profile::view')->withSuccess("Profile Saved !!");
    }
}
