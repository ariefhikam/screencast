@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Tag</div>
                    <div class="panel-body">
                        <form role="form" role="form" method="POST" action="{{ route('tag::update',['id'=>$table->id]) }}">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <fieldset>
                                @include('tag._form')
                                <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i>Update</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">All Tags</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Display Name</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($tag as $data)
                              <tr>
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->display_name }}</td>
                                  <td>
                                    <div class="actionBar">
                                        <a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg></a>
                                        <a href="{{route('tag::delete',['id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg></a>
                                    </div>
                                      
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $tag->render() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('tag::index')}}">Tag</a></li>
    <li class="active">Edit</li>
@endpush
