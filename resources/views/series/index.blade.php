@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      All Series

                      <div class="addButton pull-right">
                        <a href="{{route('series::create')}}">
                          <svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Add Series
                        </a>
                      </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Image</th>
                                  <th>Created By</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($series as $data)
                              <tr>
                                  <td>{{ $data->display_name or '' }}</td>
                                  <td>
                                  {{ (isset($data->description)) ? str_limit($data->description) : '' }}</td>
                                  <td>
                                    @if(isset($data->image))
                                      <img src="{{ route('image',['storage'=>'series','name'=>$data->image]) }}?w=100&h=50" class="img-responsive">
                                    @else
                                      <img src="/assets/img/noimage.jpg" class="img-responsive">
                                    @endif
                                  </td>
                                  <td>{{ $data->user->profile->name or '' }}</td>
                                  <td>
                                    <div class="actionBar">
                                        <a href="{{route('lessons::create',['series_id'=>$data->id,'slug'=>$data->permalink])}}"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg> Add Lessons</a>
                                        </br>
                                        <a href="{{route('series::edit',['id'=>$data->id])}}"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Edit</a>
                                        </br>
                                        <a href="{{route('series::delete',['id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg> Delete</a>
                                    </div>
                                      
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $series->render() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('tag::index')}}">User</a></li>
    <li class="active">All Users</li>
@endpush
