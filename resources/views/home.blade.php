@extends('layouts.app')

@section('content')
<div style="height:20px"></div>
<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        <h2>Hi, {{ Auth::user()->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class="active">Dashboard</li>
@endpush
