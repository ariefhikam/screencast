<form role="search">
	<div class="form-group">
		<input type="text" class="form-control" placeholder="Search">
	</div>
</form>
<ul class="nav menu">
	<li><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
	<li><a href="#"><svg class="glyph stroked video"><use xlink:href="#stroked-video"/></svg> Lessons</a></li>
	<li><a href="#"><svg class="glyph stroked open folder"><use xlink:href="#stroked-open-folder"/></svg> Series</a></li>
	<li><a href="#"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Issue</a></li>
	<li class="{{ Request::is('tag/*') ? 'active' : '' }}"><a href="{{route('tag::index')}}"><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Tag</a></li>
	<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Users</a></li>
	<!-- <li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Alerts &amp; Panels</a></li>
	<li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
	<li class="parent ">
		<a href="#">
			<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown 
		</a>
		<ul class="children collapse" id="sub-item-1">
			<li>
				<a class="" href="#">
					<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
				</a>
			</li>
			<li>
				<a class="" href="#">
					<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
				</a>
			</li>
			<li>
				<a class="" href="#">
					<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
				</a>
			</li>
		</ul>
	</li> -->
	<li role="presentation" class="divider"></li>
	
</ul>