<!DOCTYPE html>
<html>
<head>
	<title>Explore - ScreenCasters</title>

	<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="/assets/admin/css/datepicker3.css" rel="stylesheet"> -->
	<link href="/assets/stylesheet.css" rel="stylesheet">

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
	<div id='content-page'>
		<div class="container">
			<div class="space15"></div>
			<div class="row">
				<div class="col-md-3">
					<div class="space30"></div>
					<div class="space15"></div>
					<div id='left-nav-explore' style='margin-top:5px;' class="">
						<h4>Categories</h4>
						<ul class="nav nav-pills nav-stacked">
							<li role="presentation" class="{{ Request::is('explore') ? 'active' : '' }}"><a href="{{route('explore')}}">All</a></li>
						@foreach($tag as $data)
							<li role="presentation" class="{{ Request::is('*/'.$data->name) ? 'active' : '' }}"><a href="{{route('explore',['tag'=>$data->name])}}">{{$data->display_name or ''}}</a></li>
						@endforeach
						</ul>
					</div>
				</div>
				<div class="col-md-8">
					<div class="row">
						<form action="" method="GET" class="col-xs-12">
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="Search for...">
							      <span class="input-group-btn">
							        <button class="btn btn-default" type="submit">Go!</button>
							      </span>
							</div>
						</form>
					</div>
					<div class="space15"></div>
					<div class="row">
					@foreach($series as $data)
						<div class="col-lg-4">
							<a href="{{route('series::view',['slug'=>$data->permalink,'id'=>$data->id])}}">
								<div class="normalbox">
									<div class="normalbox-image">
										<img src="{{ route('image',['storage'=>'series','name'=>$data->image]) }}">
									</div>
									<div class="normalbox-label clearfix">
										<h4 class="pull-left">{{$data->display_name or ''}}</h4>
										<div class="normalbox-count pull-right text-right">
											<span>{{$data->lessons->count()}}</span>videos
										</div>
									</div>

								</div>
							</a>
							<div class="space30"></div>
						</div>
					@endforeach
					<div class="col-xs-12">
						{!! $series->render() !!}
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id='footer-page'>
		@include('sites._footer')
	</div>
	<script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
	<script src="/assets/admin/js/bootstrap.min.js"></script>
	<script src="/assets/admin/js/lumino.glyphs.js"></script>
</body>
</html>