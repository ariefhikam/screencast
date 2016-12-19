<!DOCTYPE html>
<html>
<head>
	<title>{{ $table->display_name or '' }} - ScreenCasters</title>

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
				<h1 class="first-tag">{{ $table->display_name or '' }}</h1>
				<h2 class="sec-tag">{{ $table->description or '' }}</h2>
			</div>
		</div>
	</div>
	<div id='content-page' style="min-height:500px;">
		<div class="container">
			<div class="space15"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h3>Lessons Series</h3>
					</div>
					<div class="col-md-8 col-md-offset-2">
						<ul class="list-group">
						@foreach($table->lessons as $data)
							<a href="{{ route('lessons::view',['slug'=>$data->permalink,'id'=>$data->id]) }}" class="list-group-item">
								@if($data->price != '0.00')
									<span class="badge">Rp. {{ $data->price }}</span>
								@else
									<span class="badge">Free</span>
								@endif
							    <h4 class="list-group-item-heading">{{ $data->display_name }}</h4>
							    <p class="list-group-item-text">{{ str_limit($data->description,100) }}</p>
							</a>
						@endforeach
						</ul>
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