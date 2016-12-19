@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Category</div>
                    <div class="panel-body">
                        <form role="form" role="form" method="POST" action="{{ route('category::update',['id'=>$table->id]) }}">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <fieldset>
                                @include('category._form')
                                <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i>Update</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">All Category</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($category as $data)
                              <tr>
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->description }}</td>
                                  <td>
                                    <div class="actionBar">
                                        <a href="{{route('category::edit',['id'=>$data->id])}}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg></a>
                                        <a href="{{route('category::delete',['id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg></a>
                                    </div>
                                      
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $category->render() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('issue::index')}}">Issue</a></li>
    <li class=""><a href="{{route('category::index')}}">Category</a></li>
    <li class="active">Edit</li>
@endpush
