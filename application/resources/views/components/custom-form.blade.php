<div class="col-md-12 text-center">
    @foreach ($formData as $data)
        <div class="form-group mb-4">
            @if ($data->type == 'text')
                <input type="text" class="form-control form--control" name="{{ $data->label }}"
                    value="{{ old($data->label) }}" placeholder="" @if ($data->is_required == 'required') required @endif>
            @elseif($data->type == 'textarea')
                <textarea class="form-control form--control" name="{{ $data->label }}" @if ($data->is_required == 'required') required @endif>{{ old($data->label) }}</textarea>
            @elseif($data->type == 'select')
                <select class="form-control form--control" name="{{ $data->label }}"
                    @if ($data->is_required == 'required') required @endif>
                    <option value="">@lang('Sélectionnez-en un')</option>
                    @foreach ($data->options as $item)
                        <option value="{{ $item }}" @selected($item == old($data->label))>{{ __($item) }}</option>
                    @endforeach
                </select>
            @elseif($data->type == 'checkbox')
                @foreach ($data->options as $option)
                    <div class="form-check">
                        <input class="form-check-input" name="{{ $data->label }}[]" type="checkbox"
                            value="{{ $option }}" id="{{ $data->label }}_{{ titleToKey($option) }}">
                        <label class="form-check-label"
                            for="{{ $data->label }}_{{ titleToKey($option) }}">{{ $option }}</label>
                    </div>
                @endforeach
            @elseif($data->type == 'radio')
                @foreach ($data->options as $option)
                    <div class="form-check">
                        <input class="form-check-input" name="{{ $data->label }}" type="radio"
                            value="{{ $option }}" id="{{ $data->label }}_{{ titleToKey($option) }}"
                            @checked($option == old($data->label))>
                        <label class="form-check-label"
                            for="{{ $data->label }}_{{ titleToKey($option) }}">{{ $option }}</label>
                    </div>
                @endforeach
            @elseif($data->type == 'file')
                <input type="file" class="form-control form--control" name="{{ $data->label }}"
                    @if ($data->is_required == 'required') required @endif
                    accept="@foreach (explode(',', $data->extensions) as $ext) .{{ $ext }}, @endforeach">
                <pre class="text--base mt-1">@lang('Mimes pris en charge'): {{ $data->extensions }}</pre>
            @endif
            <label class="form--label">{{ __($data->name) }}</label>
        </div>
    @endforeach
</div>
