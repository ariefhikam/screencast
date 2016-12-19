<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"">
    <input class="form-control" placeholder="Name" name="name" type="text" autofocus="" value="{{ $table->name or '' }}">
    @if ($errors->has('name'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}"">
    <textarea class="form-control" placeholder="Description" name="description">{{ $table->description or '' }}</textarea>
    @if ($errors->has('description'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>