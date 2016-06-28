<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tag;
class TagController extends Controller
{
    //
	//protected $data;

    function __construct(){
    	//$this->data = Tag::paginate(15);
    }

    public function index(){

    	$data = Tag::orderBy('updated_at','DESC')->paginate(15);


    	return view('tag.index')->with(['tag'=>$data]);
    }

    public function store(Request $request){
    	$input = $request->all();

    	$this->validate($request, [
	        'display_name' => 'required|max:20'
	    ]);

    	$input['name'] = $input['display_name'];

	    $table = new Tag;
	    $table->fill($input);
	    $table->save();

	    return redirect()->route('tag::index')->withSuccess("Record Added !!");
    }

    public function destroy($id){

    	$table = Tag::findOrFail($id);
    	$table->delete();

    	return redirect()->route('tag::index')->withSuccess("Record Deleted !!");
    }

    public function edit($id){
    	$data = Tag::orderBy('updated_at','DESC')->paginate(15);

    	$table = Tag::findOrFail($id);

    	return view('tag.update')->with(['tag'=>$data,'table'=>$table]);
    }

    public function update(Request $request, $id){
    	$table = Tag::findOrFail($id);

    	$this->validate($request, [
	        'display_name' => 'required|max:20'
	    ]);

    	$input = $request->all();
    	$input['name'] = $input['display_name'];
	    $table->fill($input);
	    $table->save();

	    return redirect()->route('tag::edit',['id'=>$id])->withSuccess("Change Saved !!");
    }
}
