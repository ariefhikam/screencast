<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Package;
use App\Tag;
use Auth;
use Storage;
use File;
use Validator;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',
                ['only' => ['index','create', 'store','update','edit','destroy','indexUnconfirm','confirm','unconfirm','editPassword','updatePassword']
            ]);
        $this->middleware('role:admin', 
                ['only' => ['index','create','update','edit','destroy','indexUnconfirm','confirm','unconfirm']
            ]);
        $this->middleware('verifyUser', 
                ['only' => ['editPassword','updatePassword']
            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::with('tag')->where('confirmed',1)->paginate(15);
        return view('post.index')->with('post',$post);
    }

    public function indexUnconfirm()
    {
        $post = Post::with('tag')->where('confirmed',0)->paginate(15);
        return view('post.index')->with('post',$post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('image');
        $table = new Post;
        $messages = array(
            'required' => 'The :attribute is really important.',
            'regex'  => 'The :attribute format is invalid.',
            'numeric'  => 'The :attribute must be integer.',
            'string'  => 'The :attribute must be string.',
        );

        $validator = Validator::make($request->all(), [
            'title' => "required|max:255|regex:/^[^\\\\]*$/",
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator->messages())
                        ->withInput();
        }
        $input['user_id'] =  Auth::user()->id;
        $input['permalink'] = $table->permalink($input['title']).'-'.str_random(5);

        if($request->file('image')!=''){
            $file = $request->file('image');
            $fileName = str_random(10).$table->permalink($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put('slide/'.$fileName,  File::get($file));
            $input['thumbnail'] = $fileName;
            $input['thumbnail_type'] = $file->getClientMimeType();
        }
        //dd($input);
        $table->fill($input);
        $table->users_id = Auth::user()->id;
        $table->save();

        if(isset($input['tags'])){
            foreach ($input['tags'] as $tag) {
                $table->tag()->attach($tag);
            }
        }
        if (strpos($request->server('HTTP_REFERER'),'user')) {
            return redirect()->route('user::stories')
            ->withSuccess("Thanks to share your stories. your stories need to confirm by administrator");
        }
        return redirect()->route('post::create')
            ->withSuccess("Success Create New Post");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('tag')->findOrFail($id);
        return view('post.edit')->with(['data'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $input = $request->except('image');
        $messages = array(
            'required' => 'The :attribute is really important.',
            'regex'  => 'The :attribute format is invalid.',
            'numeric'  => 'The :attribute must be integer.',
            'string'  => 'The :attribute must be string.',
        );

        $validator = Validator::make($input, [
            'title' => "required|max:255|regex:/^[^\\\\]*$/",
            //'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ],$messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator->messages())
                        ->withInput();
        }
        $input['user_id'] =  Auth::user()->id;

        if($request->file('image')!=''){
            $file = $request->file('image');
            $fileName = str_random(10).$post->permalink($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            Storage::disk('local')->put('slide/'.$fileName,  File::get($file));
            $input['thumbnail'] = $fileName;
            $input['thumbnail_type'] = $file->getClientMimeType();
        }


        $post->fill($input)->save();
        if(isset($input['tags'])){
            $post->tag()->sync($input['tags']);
        }
        return redirect()->back()->withSucces("<strong>Success</strong> Edit Post #".$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tag()->detach();
        $post->delete();

        return redirect()->route('post::index')->withSuccess("Success Delete Post");
    }

    public function all(Request $request)
    {
        $post = Post::with('tag','user');
        $input = $request->only(['take','skip']);
        if(isset($input['skip'])){
            $post->skip($input['skip']);
        }

        if(isset($input['take'])){
            $post->take($input['take']);
        }
        //dd($Post);
        return response()->json($post->get());
    }

    public function showPost($id)
    {
        $post = Post::with('tag')->findOrFail($id);
        return response()->json($post);
    }

    public function viewPost($permalink,$id){
        $package = Package::where('name','not like','uncategorized')->get();
        $table = Post::with('tag','user')->findOrFail($id);
        $table->view = $table->view +1;
        $table->save();

        $posts = Post::orderBy('view','DESC')->take(3)->get();
         $tag = Tag::take(5)->get();
        return view('post.view')->with(['post'=>$table,'package'=>$package,'posts'=>$posts,'tag'=>$tag]);
    }


    public function confirm($id){
        $post = Post::findOrFail($id);
        $post->confirmed = 1;
        $post->save();

        return redirect()->route('post::indexUnconfirm')->withSuccess("Success Confirm Post");
    }

    public function unconfirm($id){
        $post = Post::findOrFail($id);
        $post->confirmed = 0;
        $post->save();

        return redirect()->route('post::index')->withSuccess("Success Confirm Post");
    }
}
