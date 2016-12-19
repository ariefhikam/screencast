@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Edit Lessons, <small><strong>{{$series->display_name}}</strong> Series</small>
                </div>
                <div class="panel-body">
                    <form action="{{route('lessons::update',['id'=>$table->id])}}" method="POST" role='form' enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                      {!! csrf_field() !!}
                        @include('lessons._form')
                        <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Video Lessons
                </div>
                <div class="panel-body">
                    <video id="video" class="video-js vjs-default-skin"
                      controls preload="auto" width="100%" height="264"
                      poster="http://video-js.zencoder.com/oceans-clip.png"
                      data-setup='{"example_option":false}'>
                     <source src="https://archive.org/download/ElephantsDream/ed_hd.mp4" type="video/mp4" />
                     <source src="http://video-js.zencoder.com/oceans-clip.webm" type="video/webm" />
                     <source src="http://video-js.zencoder.com/oceans-clip.ogv" type="video/ogg" />
                     <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                    </video>
                </div>
            </div>
        </div>
</div>
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            All Lessons, <small><strong>{{$series->display_name}}</strong> Series</small>
          </div>
          <div class="panel-body">
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($lessons as $data)
                    <tr>
                        <td>
                        <h4>{{ $data->display_name }}</h4>
                        <p>{{ str_limit($data->description,40) }}</p>
                        </td>
                        <td>{{ $data->price }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>
                          <div class="actionBar">
                              <a href="{{route('lessons::edit',['id'=>$data->id])}}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>Edit</a></br>
                              <a href="{{route('lessons::delete',['id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>Delete</a>
                          </div>
                            
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $lessons->render() !!}
          </div>
      </div>
  </div>
</div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('series::index')}}">Series</a></li>
    <li class=""><a href="{{route('lessons::index')}}">Lessons</a></li>
    <li class="active">Add Lessons</li>
@endpush

@push('css')
<link href="/bower_components/video.js/dist/video-js.min.css" rel="stylesheet">
<link href="/assets/costumize-videojs.css" rel="stylesheet">
<style type="text/css">
  .video-dimensions{
    width: 100%;
  }

  .video-js{
    width: 100%;
  }
</style>
@endpush

@push('js')
<script type="text/javascript" src="/bower_components/video.js/dist/video.min.js" ></script>
<script>
  videojs.options.flash.swf = "/bower_components/video.js/dist/video-js.swf"
</script>
@endpush
