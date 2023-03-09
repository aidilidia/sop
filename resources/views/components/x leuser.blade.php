<div class="form-group row">
    <label for="{{$field}}" class="col-md-4 col-form-label text-md-right">{{$label}}</label>
    <div class="col-md-6">
        <select id="{{$field}}" class="form-select shadow-none border-0 ps-0 form-control-line @error($field) is-invalid @enderror" name="{{$field}}" autocomplete="{{$field}}" autofocus required>
            <option>
            @isset($value)
            {{ old($field) ? old($field) : $value }}
            @else
            {{ old($field) }}
            @endisset
            </option>
            
            @foreach ($fors as $field)
            <option>{{$option}}</option>
            @endforeach
            
            <option>User</option>
            <option>Validator</option>
            <option>Admin</option>
        </select>
    </div>
</div>