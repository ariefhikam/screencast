<a href="{{url('/')}}">
	<h2 class="title-page pull-left">ScreenCasters</h2>
</a>
@if(!Auth::check())
<div class="right-sign pull-right">
	<a href="{{url('/login')}}" class="masuk">Masuk</a>
	<a href="{{url('/register')}}" class="btn btn-cast">Daftar Sekarang</a>
</div>
@else
    <div class="right-sign pull-right">
     <ul class="nav navbar-nav navbar-right">
     	<li class="dropdown">
     		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, {{Auth::user()->name}}
            <img src="/assets/img/p1.jpg" width="24px;" class="img-circle">
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/home')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dasboard</a></li>
            <li><a href="{{route('lessons::index')}}"><svg class="glyph stroked camcorder"><use xlink:href="#stroked-camcorder"/></svg> Lessons</a></li>
            <li><a href="{{route('series::index')}}"><svg class="glyph stroked open folder"><use xlink:href="#stroked-video"/></svg> Series</a></li>
            <li><a href="{{ url('/logout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
          </ul>
     	</li>
     </ul>
    </div>
@endif