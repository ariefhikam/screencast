@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Change Password

                    </div>
                    <div class="panel-body">
                        <form action="{{route('user::change::password::store',['id'=>$table->id])}}" method="POST" role='form' class="">
                          {!! csrf_field() !!}
                          <input type="hidden" name="_method" value="PUT">
                          <div class="form-horizontal">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Name</label>
                              <div class="col-sm-10">
                                <p class="form-control-static">{{ $table->profile->name or '' }}</p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                <p class="form-control-static">{{ $table->email or '' }}</p>
                              </div>
                            </div>
                          </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" placeholder="Re-Type Password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i> Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('tag::index')}}">User</a></li>
    <li class="active">Add Users</li>
@endpush
