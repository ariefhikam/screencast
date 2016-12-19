@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Enrole Users
                </div>
                <div class="panel-body">
                    <form action="{{route('lessons::enrole::store',['id'=>$table->id])}}" method="POST" role='form' enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                          <input type="hidden" name="_method" value="PUT">
                          <select id='taginput' name="user[]" class="form-control ">
                          </select>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-btn fa-sign-in"></i> Add</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
          <div class="panel panel-default">
              <div class="panel-heading">
                All Users in this lessons, <small><strong>{{$table->display_name}}</strong> Lessons</small>
              </div>
              <div class="panel-body">
                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($table->roled as $data)
                        <tr>
                            <td>{{ $data->email or '' }}</td>
                            <td>{{ $data->name or '' }}</td>
                            <td>
                              <div class="actionBar">
                                  <a href="{{route('lessons::enrole::delete',['id'=>$table->id,'user_id'=>$data->id])}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"/></svg>Delete</a>
                              </div>
                                
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
          </div>
      </div>
</div>
<div class="row">
  
</div>
@endsection


@push('breadcumb')
    <li><a href="#"><svg class="glyph stroked home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-home"></use></svg></a></li>
    <li class=""><a href="{{route('series::index')}}">Series</a></li>
    <li class=""><a href="{{route('lessons::index')}}">Lessons</a></li>
    <li class="active">Enrole Users</li>
@endpush

@push('css')
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css" media="screen" title="no title" charset="utf-8">
@endpush

@push('js')
    <script src="/bower_components/select2/dist/js/select2.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $select2Elm = $('#taginput');
            $select2Elm.select2({
                    placeholder: "Search Users with email",
                    ajax: {
                        url: "{{URL::route('user::json')}}",
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                          return {
                            q: params.term, // search term
                            //page: params.page
                          };
                        },
                        processResults: function (data, page) {
                          // parse the results into the format expected by Select2.
                          // since we are using custom formatting functions we do not need to
                          // alter the remote JSON data
                          return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                          };
                        },
                        cache: true
                      },
            });
            
        });
    </script> 
@endpush

