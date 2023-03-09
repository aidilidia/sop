<div class="form-group row">
    <label for="{{$field}}" class="col-md-4 col-form-label text-md-right">{{$label}}</label>
    <div class="col-md-6">
        <input id="{{$field}}" type="{{$type}}" class="form-control @error($field) is-invalid @enderror"  name="{{$field}}"
        
        @isset($value)
        value="{{ old($field) ? old($field) : $value }}"
        @else
        value="{{ old($field) }}"
        @endisset
        
        autocomplete="{{$field}}" autofocus>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>