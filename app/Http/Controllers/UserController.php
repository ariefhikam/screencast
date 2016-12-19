<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Profile;
use App\Role;
class UserController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth',['except'=>['json']]);
        $this->middleware('role:admin',['except'=>['changePassword','storePassword']]);
        $this->middleware('verifyUser', ['only' => ['changePassword','storePassword']]);
    }

    public function index(){
    	$table = User::orderBy('updated_at','DESC')->with('profile','roles')->paginate(15);

    	return view('user.index')->with(['user'=>$table]);
    }

    public function destroy($id){
    	$table = User::findOrFail($id);
    	$table->delete();

    	return redirect()->route('user::index')->withSuccess("Record Deleted !!");
    }

    public function create(){
    	return view('user.create');
    }

    public function store(Request $request){
        $input = $request->except(['role']);

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role'=>'required'
        ]);
        $input['password'] = bcrypt($input['password']);
        $table = new User;
        $table->fill($input);
        $table->save();
        $table->assignRole($request->role);
        $profile = new Profile(['name' => $request->name]);
        $table->profile()->save($profile);
        return redirect()->route('user::create')->withSuccess("Record Added !!");
    }

    public function changePassword($id){
        $table = User::findOrFail($id);

        return view('user.changePassword')->with(['table'=>$table]);
    }

    public function storePassword(Request $request,$id){
        $input = $request->all();

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);
        $input['password'] = bcrypt($input['password']);
        $table = User::findOrFail($id);
        $table->fill($input);
        $table->save();

        return redirect()->route('user::change::password',['id'=>$table->id])->withSuccess("Change Saved !!");
    }

    public function changeRole($id){
        $table = User::with('roles')->findOrFail($id);

        return view('user.changeRole')->with(['table'=>$table]);
    }

    public function storeRole(Request $request,$id){
        $input = $request->all();

        $this->validate($request, [
            'role'=>'required'
        ]);
        $table = User::findOrFail($id);
        //dd($request->role);
        //dd(Role::where('name','like',$request->role)->get());
        $role = Role::where('name',$request->role)->get()->first()->id;
        $table->roles()->sync([$role]);
        return redirect()->route('user::change::role',['id'=>$table->id])->withSuccess("Change Saved !!");
    }

    public function json(Request $request){
        $tags = User::where('email','like','%'.$request['q'].'%')->paginate(5);
        foreach ($tags as $tag) {
                $result[] = ['id' => $tag->id,'name' => $tag->email ];
        }

        return response()->json($result);
    }
}
