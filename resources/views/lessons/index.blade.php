@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel-group row" id="accordion" role="tablist" aria-multiselectable="true">
		  @foreach($series as $data)
		  <div class="col-md-6" style="padding-bottom:10px;">
		  	<div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="{{$data->permalink}}{{$data->id}}">
			      <h4 class="panel-title">
			        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$data->permalink}}" aria-controls="{{$data->permalink}}">{{$data->display_name}}</a>
			        <div class="btn-group pull-right">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="{{route('lessons::create',['slug'=>$data->permalink,'series_id'=>$data->id])}}">Add Lessons</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a href="{{route('series::edit',['id'=>$data->id])}}">Edit Series</a></li>
					    <li><a href="{{route('series::delete',['id'=>$data->id])}}">Delete Series</a></li>
					  </ul>
					</div>
			      </h4>
			    </div>
			    <div id="{{$data->permalink}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$data->permalink}}{{$data->id}}">
			      <div class="panel-body">
			        <ul class="list-group">
					  	@foreach($data->lessons as $lessons)
					  	<li class="list-group-item clearfix">
						    <h4>{{ $lessons->display_name }}</h4>
						    <p>{{ str_limit($lessons->description,40) }}</p>
					  		<div class="actionBar pull-right">
					  			<a href="{{route('lessons::enrole',['id'=>$lessons->id])}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Enrole Users</a>
	                            <a href="{{route('lessons::edit',['id'=>$lessons->id])}}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>Edit</a>
	                            <a href="{{route('lessons::delete',['id'=>$lessons->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>Delete</a>
	                          </div>
						</li>
			        	@endforeach
					    
					</ul>
			        <div>
			        	
			        </div>
			      </div>
			    </div>
			  </div>
		  </div>
		  @endforeach
		</div>
	</div>
</div>
@endsection