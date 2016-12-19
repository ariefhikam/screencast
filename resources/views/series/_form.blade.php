<div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}"">
    <input class="form-control" placeholder="Series Name" name="display_name" type="text" autofocus="" value="{{$table->display_name or ''}}">
    @if ($errors->has('display_name'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}"">
      <textarea class="form-control" placeholder="A few explanation about your learning series" name="description" type="email" autofocus="" >{{ $table->description or '' }}</textarea>
      @if ($errors->has('description'))
          <span class="help-block text-danger">
              <strong>{{ $errors->first('description') }}</strong>
          </span>
      @endif
  </div>
  <div class="form-group clearfix {{ $errors->has('picture') ? ' has-error' : '' }}">
    <div class="col-xs-4">
    @if(isset($table->image))
      <img src="{{ route('image',['storage'=>'series','name'=>$table->image]) }}?w=200&h=100" class="img-responsive">
    @else
      <img src="/assets/img/noimage.jpg" class="img-responsive">
    @endif
    </div>
    <div class="col-xs-8">
      <label>Thumbnail Image</label>
      <input class="form-control" placeholder="Thumbnail Image" name="picture" type="file">
      @if ($errors->has('picture'))
          <span class="help-block text-danger">
              <strong>{{ $errors->first('picture') }}</strong>
          </span>
      @endif
    </div>
  </div>