<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Issues;
Use Auth;
class IssuesController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index(){
    
    	$issue = Issues::with('user','category')->orderBy('created_at','DESC')->paginate();

    	return view('issues.index')->with(['issue'=>$issue]);
    }

    public function store(Request $request){

    	$input = $request->all();

    	$table = new Issues;
    	$input['user_id'] = Auth::user()->id;
    	$table->fill($input);
    	//dd($input);
    	$table->save();

    	return redirect()->back()->withSuccess("Users Deleted");
    }

    public function destroy($id){

        $table = Issues::findOrFail($id);
        $table->delete();

        return redirect()->route('issue::index')->withSuccess("Record Deleted !!");
    }
}
