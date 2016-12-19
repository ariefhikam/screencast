@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading">{{ $table->name }}'s Profile
            @if(Auth::user()->id == $table->user->id)
				<div class="addButton pull-right">
		            <a href="{{route('profile::edit',['id'=>$table->id])}}">
		              <svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"/></svg>Edit
		            </a>
		          </div>
		    @endif
            </div>
            <div class="panel-body">
            	<div class="row">
            		<div class="col-md-4">
            			<img src="{{ route('image',['storage'=>'profile','name'=>$table->image]) }}" class="img-responsive">
            			<p>{{ $table->about or '' }}</p>
            		</div>
            		<div class="col-md-8">
            			<table class="table">
            				<tr>
            					<td><strong>Name</strong></td>
            					<td>{{ $table->name or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>Address</strong></td>
            					<td>{{ $table->address or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>State</strong></td>
            					<td>{{ $table->state or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>City</strong></td>
            					<td>{{ $table->city or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>Gender</strong></td>
            					<td>{{ $table->gender or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>Phone</strong></td>
            					<td>{{ $table->phone or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>Join</strong></td>
            					<td>{{ $table->created_at or '' }}</td>
            				</tr>
            				<tr>
            					<td><strong>Last Login</strong></td>
            					<td>{{ $table->user->updated_at or '' }}</td>
            				</tr>
            			</table>
            		</div>
            	</div>
            </div>
        </div>
	</div>
</div>


@endsection
