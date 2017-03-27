<!DOCTYPE html>
<html>
<head>
	<title>{{ $table->display_name or '' }} - ScreenCasters</title>

	<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="/assets/admin/css/datepicker3.css" rel="stylesheet"> -->
	<link href="/assets/stylesheet.css" rel="stylesheet">

	<link href="/bower_components/video.js/dist/video-js.min.css" rel="stylesheet">
	<link href="/assets/costumize-videojs.css" rel="stylesheet">
	<style type="text/css">
	  .video-dimensions{
	    width: 100%;
	  }

	  .video-js{
	    width: 100%;
	  }
	  .video-js .vjs-big-play-button{
	  	top:45%;
	  	left:45%;
	  }
	</style>

</head>
<body>
	<div id='head-page'>
		<div class="wrapper-explore">
			<div id='top-head' class="container-fluid">
				@include('sites._head')
			</div>
			<div id='mid-head-explore' class="container">
				<h1 class="first-tag">Belajar Praktis dengan ScreenCasters</h1>
				<h2 class="sec-tag">Kuasai skill baru dengan menonton screencast video</h2>
			</div>
		</div>
	</div>
	<div id='content-page' style="min-height:500px;">
		<div class="container">
			<div class="space15"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="">
						<video id="video" class="video-js vjs-default-skin"
                      controls preload="none" width="100%" height="464"
                      data-setup='{"example_option":false}'>
                      	@if((isset($table->price) && $table->price == '0.00')  || // free video
                      		(Auth::check() && $table->users_id == Auth::user()->id) || // video uploader
                      		(Auth::check() && isset($table->roled[0])) // enroled user
                      		)
	                    <source src="{{ route('video',['video'=>$table->url,'series'=>$table->series->permalink]) }}" type="video/mp4" />
	                   	{{-- @else --}}
	                   	{{-- <video poster="myPoster.jpg"> --}}
	                   	@endif
	                     <!-- <source src="http://video-js.zencoder.com/oceans-clip.webm" type="video/webm" />
	                     <source src="http://video-js.zencoder.com/oceans-clip.ogv" type="video/ogg" /> -->
	                     <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
	                    </video>
					</div>
				</div>
			</div>
			<div class="space15"></div>
			<div class="row"> 	
				<div class="col-md-7">
					<div class="content-video">
						<h2>{{ $table->display_name or '' }}</h2>
						<p>{{ $table->description or '' }}</p>
						{{ $table->url }}
						<div class="right-tag">
							@foreach($table->tag as $data)
								<a href="{{ route('explore',['tag_name'=>$data->name]) }}">	
									<span class="label label-default">{{ $data->display_name }}</span>
								</a>
							@endforeach
						</div>
						<div class="space15"></div>
					</div>
					<div class="space15"></div>
					<div class="detail-video">
						<h4>Details</h4>
						<table class="table">
							<tr>
								<td>Series</td>
								<td>
								<a href="{{ route('series::view',['slug' => $table->series->permalink,'id'=> $table->series->id]) }}" style="color:#119da4;">
									{{$table->series->display_name}}
								</a>
								</td>
							</tr>
							<tr>
								<td>Created At</td>
								<td>{{$table->created_at}}</td>
							</tr>
							<tr>
								<td>Uploaded By</td>
								<td>{{ $table->user->profile->name }}</td>
							</tr>
							<tr>
								<td>Price</td>
								<td>
								@if($table->price != '0.00')
									Rp. {{ $table->price }}
								@else
									Free
								@endif
								</td>
							</tr>
						</table>
						<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
						  <div class="modal-dialog modal-sm" role="document" >
						   <form class="form" role='form' method="POST" action="{{ route('issue::store') }}">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title">Laporkan Kesalahan</h4>
						      </div>
						      <div class="modal-body">
						       		{!! csrf_field() !!}
						        	<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"">
									    <input class="form-control" placeholder="Your Name" name="name" type="text" autofocus="">
									    @if ($errors->has('name'))
									        <span class="help-block text-danger">
									            <strong>{{ $errors->first('name') }}</strong>
									        </span>
									    @endif
									</div>
									<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}"">
									    <select class="form-control" name="category_id">
									    	@foreach($category as $data)
									    		<option value="{{ $data->id }}">{{$data->name}}</option>
									    	@endforeach
									    </select>
									    @if ($errors->has('category_id'))
									        <span class="help-block text-danger">
									            <strong>{{ $errors->first('category_id') }}</strong>
									        </span>
									    @endif
									</div>
									<div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}"">
									    <textarea class="form-control" placeholder="Messages" name="message" ></textarea>
									    @if ($errors->has('message'))
									        <span class="help-block text-danger">
									            <strong>{{ $errors->first('message') }}</strong>
									        </span>
									    @endif
									</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="submit" class="btn btn-primary">Laporkan</button>
						      </div>
						    </div><!-- /.modal-content -->
						    </form>
						  </div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<button class="btn" data-toggle="modal" data-target="#myModal">Laporkan Kesalahan</button>
						<div class="space15"></div>
					</div>
					
				</div>
				<div class="col-md-5">
					<div class="">
						<ul class="list-group">
						@foreach($anotherLessons as $data)
							<a href="{{ route('lessons::view',['slug'=>$data->permalink,'id'=>$data->id]) }}" class="list-group-item">
								@if($data->price != '0.00')
									<span class="badge">Rp. {{ $data->price }}</span>
								@else
									<span class="badge">Free</span>
								@endif
							    <h4 class="list-group-item-heading">{{ $data->display_name }}</h4>
							</a>
						@endforeach
						</ul>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="space15"></div>
	<div id='footer-page'>
		@include('sites._footer')
	</div>
	<script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
	<script src="/assets/admin/js/bootstrap.min.js"></script>
	<script src="/assets/admin/js/lumino.glyphs.js"></script>
	<script type="text/javascript" src="/bower_components/video.js/dist/video.min.js" ></script>
	<script>
	  videojs.options.flash.swf = "/bower_components/video.js/dist/video-js.swf";
	  
	  $('video').on('play', function(e) {
	  	
        $.get("{{ route('lessons::watching',['id'=>$table->id]) }}").done(function(res){
        	//console.log('success')
        });
      });

	  	
	</script>
</body>
</html>