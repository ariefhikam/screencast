<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;
class CategoryController extends Controller
{
    //
	//protected $data;

    function __construct(){
    	//$this->data = Tag::paginate(15);
    }

    public function index(){

    	$data = Category::orderBy('updated_at','DESC')->paginate(15);


    	return view('category.index')->with(['category'=>$data]);
    }

    public function store(Request $request){
    	$input = $request->all();

    	$this->validate($request, [
	        'name' => 'required|max:20'
	    ]);
    	//dd($input);
	    $table = new Category;
	    $table->fill($input);
	    $table->save();

	    return redirect()->route('category::index')->withSuccess("Record Added !!");
    }

    public function destroy($id){

    	$table = Category::findOrFail($id);
    	$table->delete();

    	return redirect()->route('category::index')->withSuccess("Record Deleted !!");
    }

    public function edit($id){
    	$data = Category::orderBy('updated_at','DESC')->paginate(15);

    	$table = Category::findOrFail($id);

    	return view('category.update')->with(['category'=>$data,'table'=>$table]);
    }

    public function update(Request $request, $id){
    	$table = Category::findOrFail($id);

    	$this->validate($request, [
	        'name' => 'required|max:20'
	    ]);

    	$input = $request->all();

	    $table->fill($input);
	    $table->save();

	    return redirect()->route('category::edit',['id'=>$id])->withSuccess("Change Saved !!");
    }
}
