@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Add Users

                    </div>
                    <div class="panel-body">
                        <form action="{{route('user::store')}}" method="POST" role='form'>
                          {!! csrf_field() !!}
                          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"">
                              <input class="form-control" placeholder="Full Name" name="name" type="text" autofocus="" value="{{ old('name') }}">
                              @if ($errors->has('name'))
                                  <span class="help-block text-danger">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
                            <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                <select name="role" class="form-control">
                                  <option value="" disabled selected hidden>Select Role</option>
                                  <option value="admin">Administrator</option>
                                  <option value="screencaster">Screencaster</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
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
