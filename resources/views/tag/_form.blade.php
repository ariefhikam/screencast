<div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}"">
    <input class="form-control" placeholder="Tag Name" name="display_name" type="text" autofocus="" value="{{ $table->display_name or '' }}">
    @if ($errors->has('display_name'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
    @endif
</div>
