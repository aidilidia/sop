<div class="form-group row">
    <label for="{{$field}}" class="col-md-4 col-form-label text-md-right">{{$label}}</label>
    <div class="col-md-6">
        <select id="{{$field}}" class="form-select select2 shadow-none border-0 ps-0 form-control-line @error($field) is-invalid @enderror" name="{{$field}}" autocomplete="{{$field}}" autofocus>
            <option>
            @isset($value)
            {{ old($field) ? old($field) : $value }}
            @else
            {{ old($field) }}
            @endisset
            </option>
            

            @foreach ({{$for}} as {{$as}})
            <option>{{$option}}</option>
            @endforeach
            
        </select>
        @error($field)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>