<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Series;
Use App\Tag;
use DB;
class SitesController extends Controller
{
    //
    public function homepage(){

    	/*
			Query Builder untuk ngambil 3 teratas berdasarkan jumlah video lessons yang di tonton.
			lebih simple pake query builder dari pada pake Eloquent

			tapi Query builder return array biasa bukan collection -_-
    	*/
    	$top3series = DB::table('series')
    				->join('lessons','series.id','=','lessons.series_id')
    				->select('series.*',DB::raw('sum(lessons.watch) as watch'))
    				->orderBy('watch','DESC')
    				->groupBy('series.display_name')
    				->take(3)
    				->get();
    				//->first();
    	$series = Series::with('lessons')
    				->orderBy('updated_at','DESC')
    				->take(8)
    				->get();
    	//dd($top3series);
    	return view('sites.homepage')->with(['top3series'=>$top3series,'series'=>$series]);
    }

    public function explore(Request $request,$tag_name = null){

        $tag = Tag::all();
        $table = Series::join('lessons','series.id','=','lessons.series_id');
        
        $table->select('series.*',
                DB::raw('count(lessons.id) as count')
        );
        if($tag_name != null){
            $table->join('lessons_tag','lessons.id','=','lessons_tag.lesson_id');
            $table->join('tag','tag.id','=','lessons_tag.tag_id');
            $table->where('tag.name',$tag_name);
            //->paginate(9);
        }else{

            $table->orderBy('series.updated_at','DESC');
            //->paginate(9);
        }

        if(isset($request->search)){
            $table->where('series.display_name','like','%'.$request->search.'%');
            $table->OrWhere('lessons.display_name','like','%'.$request->search.'%');
            if($tag_name != null){
                $table->OrWhere('tag.display_name','like','%'.$request->search.'%');
            }
        }
        $table->groupBy('series.permalink');
        //dd($table);
        $table = $table->paginate(9); // harus kaya gini, gak bisa return langsung.

        return view('sites.explore')->with(['tag'=>$tag,'series'=>$table]);
    }
}
