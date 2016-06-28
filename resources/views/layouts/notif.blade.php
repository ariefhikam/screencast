<div class="col-md-12">
	@if(Session::has('success'))
	<div class="alert bg-success" role="alert">
		<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg> 
		{!! Session::get("success") !!} <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
	</div>
	@endif
</div>