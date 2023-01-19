<div class="form-check">
    @foreach ($options as $key => $option)
        <input type="checkbox" {{ $attributes->merge($attrs) }} value="{{ $key }}">
        <label for="{{ $attrs['name'] }}"> {{ $option }}</label><br>
    @endforeach
</div>
