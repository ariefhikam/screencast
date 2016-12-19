<!DOCTYPE html>
<html>
<head>
	<title>ScreenCasters</title>

	<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="/assets/admin/css/datepicker3.css" rel="stylesheet"> -->
	<link href="/assets/stylesheet.css" rel="stylesheet">

</head>
<body>
	<div id='head-page'>
		<div class="wrapper">
			<div id='top-head' class="container-fluid">
				@include('sites._head')
			</div>
			<div class="space200"></div>
			<div id='mid-head' class="container">
				<h1 class="first-tag">Belajar Praktis dengan ScreenCasters</h1>
				<h2 class="sec-tag">Kuasai skill baru dengan menonton screencast video</h2>
				<a href="{{url('/explore')}}" class="btn btn-cast btn-lg btn-mulai">Mulai <svg class="glyph stroked chevron right"><use xlink:href="#stroked-chevron-right"/></svg></a>
			</div>
		</div>
	</div>
	<div id='content-page'>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h3 class="title-section">Series</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6" style="padding-right:2px;">
					<a href="{{ route('series::view',['slug'=>$top3series[0]->permalink,'id'=>$top3series[0]->id]) }}">
						<div id='top3box-1' class="top3box">
							<img src="{{ route('image',['storage'=>'series','name'=>$top3series[0]->image]) }}" class="">
							<div class="top3box-wrapper col-xs-12" style="padding-right:2px;">
								<div class="wrapper">
									<div class="label-top3box">
										{{$top3series[0]->display_name or ''}}
									</div>
								</div>
							</div>						
						</div>
					</a>
				</div>
				@if(isset($top3series[1]))
				<div class="col-lg-6" style="padding-bottom:2px;padding-left:2px;">
					<a href="{{ route('series::view',['slug'=>$top3series[1]->permalink,'id'=>$top3series[1]->id]) }}">
						<div id='top3box-2' class="top3box top3box2">
							<img src="{{ route('image',['storage'=>'series','name'=>$top3series[1]->image]) }}" class="">
							<div class="top3box-wrapper col-xs-12" style="padding-left:2px;">
								<div class="wrapper">
									<div class="label-top3box">
										{{$top3series[1]->display_name or ''}}
									</div>
								</div>
							</div>						
						</div>
					</a>
				</div>
				@endif
				@if(isset($top3series[2]))
				<div class="col-lg-6" style="padding-top:2px;padding-left:2px;">
					<a href="{{ route('series::view',['slug'=>$top3series[2]->permalink,'id'=>$top3series[2]->id]) }}">
						<div id='top3box-2' class="top3box top3box2">
							<img src="{{ route('image',['storage'=>'series','name'=>$top3series[2]->image]) }}" class="">
							<div class="top3box-wrapper col-xs-12" style="top:2px;padding-left:2px;">
								<div class="wrapper">
									<div class="label-top3box">
										{{$top3series[2]->display_name or ''}}
									</div>
								</div>
							</div>						
						</div>
					</a>
				</div>
				@endif
			</div>
			<div class="space30"></div>
			<div class="row">
			@foreach($series as $data)
				<div class="col-lg-3">
					<a href="{{ route('series::view',['slug'=>$data->permalink,'id'=>$data->id]) }}">
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