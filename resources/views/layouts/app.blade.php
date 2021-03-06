<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ScreenCaster</title>

<link href="/assets/admin/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="/assets/admin/css/datepicker3.css" rel="stylesheet"> -->
<link href="/assets/admin/css/styles.css" rel="stylesheet">
<link href="/assets/main.css" rel="stylesheet">
@stack('css')
<!--Icons-->
<script src="/assets/admin/js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Screen</span>Casters</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('profile::view') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							 <li><a href="{{ route('user::change::password',['id'=>Auth::user()->id]) }}"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Reset Password</a></li>
							<li><a href="{{ url('/logout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		@include('layouts.leftNav')
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
		    <ol class="breadcrumb">
		        @stack('breadcumb')
		    </ol>
		</div>
		<div style="height:10px"></div>
		<div class="row">
			@include('layouts.notif')
		</div>
		 @yield('content')
		
	</div><!--/.main-->

	<script src="/assets/admin/js/jquery-1.11.1.min.js"></script>
	<script src="/assets/admin/js/bootstrap.min.js"></script>
	<!-- <script src="/assets/admin/js/chart.min.js"></script> -->
	<!-- <script src="/assets/admin/js/chart-data.js"></script> -->
	<!-- <script src="/assets/admin/js/easypiechart.js"></script> -->
	<!-- <script src="/assets/admin/js/easypiechart-data.js"></script> -->
	<!-- <script src="/assets/admin/js/bootstrap-datepicker.js"></script> -->
	<!-- <script src="/assets/admin/js/bootstrap-table.js"></script> -->
	@stack('js')
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
