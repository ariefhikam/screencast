<div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}"">
    <input class="form-control" placeholder="Lesson Name" name="display_name" type="text" autofocus="" value="{{$table->display_name or ''}}">
    @if ($errors->has('display_name'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}"">
    <textarea class="form-control" placeholder="A few explanation about your video lesson" name="description" type="email" autofocus="" >{{ $table->description or '' }}</textarea>
    @if ($errors->has('description'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}"">
    <input class="form-control" placeholder="Price" name="price" type="text" autofocus="" value="{{$table->price or ''}}">
    <p class="help-block text-small">fill 0 to set free video lessons</p>
    @if ($errors->has('price'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
    @endif
</div>
<div class="form-group clearfix {{ $errors->has('url') ? ' has-error' : '' }}">
    <select id='taginput' name="tags[]" class="form-control " multiple="multiple">
      @if(isset($table->tag))
        @foreach($table->tag as $tag)
        <option value="{{$tag->id}}" selected>{{$tag->display_name}}</option>
        @endforeach
      @endif  
    </select>
</div>
<div class="form-group clearfix {{ $errors->has('url') ? ' has-error' : '' }}">
    <label>Video Lessons</label>
    <input class="form-control" name="video" type="file">
    @if ($errors->has('url'))
        <span class="help-block text-danger">
            <strong>{{ $errors->first('url') }}</strong>
        </span>
    @endif
</div>

@push('css')
    <link rel="stylesheet" href="/bower_components/select2/dist/css/select2.min.css" media="screen" title="no title" charset="utf-8">
@endpush

@push('js')
    <script src="/bower_components/select2/dist/js/select2.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $select2Elm = $('#taginput');
            $select2Elm.select2({
                    placeholder: "Tags",
                    tags: true,
                    multiple: true,
                    ajax: {
                        url: "{{URL::route('tag::json')}}",
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