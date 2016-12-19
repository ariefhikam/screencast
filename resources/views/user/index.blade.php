@extends('layouts.app')

@section('content')
<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      All Users

                      <div class="addButton pull-right">
                        <a href="{{route('user::create')}}">
                          <svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg>Add Users
                        </a>
                      </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Email</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>Role</th>
                                  <th>Last Login</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($user as $data)

                              <tr>
                                  <td>{{ $data->email }}</td>
                                  <td>{{ $data->profile->name or '' }}</td>
                                  <td>{{ $data->profile->phone or '' }}</td>
                                  <td>{{ $data->roles->first()->label or '' }}</td>
                                  <td>{{ $data->updated_at }}</td>
                                  <td>
                                    <div class="actionBar">
                                        <a href="{{route('user::change::role',['id'=>$data->id])}}"><svg class="glyph stroked eye"><use xlink:href="#stroked-eye"/></svg> Change Role</a>
                                        </br>
                                        <a href="{{route('user::change::password',['id'=>$data->id])}}"><svg class="glyph stroked key "><use xlink:href="#stroked-key"/></svg> Change Password</a>
                                        </br>
                                        <a href="{{route('user::delete',['id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg> Delete</a>
                                    </div>
                                      
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        {!! $user->render() !!}
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
