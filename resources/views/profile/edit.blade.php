@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading">Edit {{ $table->name }}'s Profile
            </div>
            <form action="{{ route('profile::update',['id'=>$table->id]) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="panel-body">
            	<div class="row">
            		<div class="col-md-4">
            			<img src="{{ route('image',['storage'=>'profile','name'=>$table->image]) }}" class="img-responsive">
                              <div class="form-group clearfix {{ $errors->has('image') ? ' has-error' : '' }}">
                                  <label>Profile Picture</label>
                                  <input class="form-control" name="image" type="file">
                                  @if ($errors->has('image'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('image') }}</strong>
                                      </span>
                                  @endif
                              </div>
            			<div class="form-group {{ $errors->has('about') ? ' has-error' : '' }}"">
                                  <textarea class="form-control" placeholder="A few explanation about you" name="about"  autofocus="" >{{ $table->about or '' }}</textarea>
                                  @if ($errors->has('about'))
                                      <span class="help-block text-danger">
                                          <strong>{{ $errors->first('about') }}</strong>
                                      </span>
                                  @endif
                              </div>
            		</div>
            		<div class="col-md-8">
            			<table class="table">
            				<tr>
            					<td><strong>Name</strong></td>
            					<td>
                                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"">
                                              <input class="form-control" placeholder="Your Name" name="name" type="text" autofocus="" value="{{$table->name or ''}}">
                                              @if ($errors->has('name'))
                                                  <span class="help-block text-danger">
                                                      <strong>{{ $errors->first('name') }}</strong>
                                                  </span>
                                              @endif
                                                </div>                         
                                          </td>
            				</tr>
            				<tr>
            					<td><strong>Address</strong></td>
            					<td>
                                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}"">
                                                    <textarea class="form-control" placeholder="Your Address" name="address"  autofocus="" >{{ $table->address or '' }}</textarea>
                                                    @if ($errors->has('address'))
                                                        <span class="help-block text-danger">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>                         
                                          </td>
            				</tr>
            				<tr>
            					<td><strong>State</strong></td>
            					<td>
                                                <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}"">
                                              <input class="form-control" placeholder="State Name" name="state" type="text" autofocus="" value="{{$table->state or ''}}">
                                              @if ($errors->has('state'))
                                                  <span class="help-block text-danger">
                                                      <strong>{{ $errors->first('state') }}</strong>
                                                  </span>
                                              @endif
                                                </div>                          
                                          </td>
            				</tr>
            				<tr>
            					<td><strong>City</strong></td>
            					<td>
                                          <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}"">
                                              <input class="form-control" placeholder="City Name" name="city" type="text" autofocus="" value="{{$table->city or ''}}">
                                              @if ($errors->has('city'))
                                                  <span class="help-block text-danger">
                                                      <strong>{{ $errors->first('city') }}</strong>
                                                  </span>
                                              @endif
                                                </div>                           
                                          </td>
            				</tr>
            				<tr>
            					<td><strong>Gender</strong></td>
            					<td>
                                               <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}"">
                                              <select class="form-control" name='gender'>
                                                    <option value='l' {{ ($table->gender == 'l')? 'selected' : ''  }}>Male</option>
                                                    <option value='p' {{ ($table->gender == 'p')? 'selected' : ''  }}>Female</option>
                                              </select>
                                              @if ($errors->has('gender'))
                                                  <span class="help-block text-danger">
                                                      <strong>{{ $errors->first('gender') }}</strong>
                                                  </span>
                                              @endif
                                                </div>                         
                                          </td>
            				</tr>
            				<tr>
            					<td><strong>Phone</strong></td>
            					<td>
                                          <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}"">
                                              <input class="form-control" placeholder="Your Phone Number" name="phone" type="text" autofocus="" value="{{$table->phone or ''}}">
                                              @if ($errors->has('phone'))
                                                  <span class="help-block text-danger">
                                                      <strong>{{ $errors->first('phone') }}</strong>
                                                  </span>
                                              @endif
                                                </div>                           
                                          </td>
            				</tr>
            			</table>
                  <button type="submit" class="btn btn-primary">Save</button>
            		</div>
            	</div>
            </div>
            </form>
        </div>
	</div>
</div>


@endsection
