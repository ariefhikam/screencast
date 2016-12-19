@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      All Reported Issues

                      <div class="addButton pull-right">
                        <a href="{{route('category::index')}}">
                          <svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Add  Issue Category
                        </a>
                      </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Messages</th>
                                  <th>Category</th>
                                  <th>Created By</th>
                                  <th>Created At</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($issue as $data)
                              <tr>
                                  <td>{{ $data->name or '' }}</td>
                                  <td>{{ $data->message or '' }}</td>
                                  <td>{{ $data->category->name }}</td>
                                  <td>{{ $data->user->email }}</td>
                                  <td>{{ $data->user->profile->name or '' }}</td>
                                  <td>
                                    <div class="actionBar">
                                        <a href="{{route('issue::delete',['id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg> Delete</a>
                                    </div>
                                      
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $issue->render() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('issue::index')}}">Issue</a></li>
    <li class="active">All Reported Issue</li>
@endpush
