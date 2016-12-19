@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Add Series

                    </div>
                    <div class="panel-body">
                        <form action="{{route('series::store')}}" method="POST" role='form' enctype="multipart/form-data">
                          {!! csrf_field() !!}
                            @include('series._form')
                            <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i> Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('series::index')}}">Series</a></li>
    <li class="active">Add Series</li>
@endpush
