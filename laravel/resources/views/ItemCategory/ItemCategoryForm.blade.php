
<div class="form-group">
    <label for="name">Name</label>
    @isset($item)
        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required>
    @else
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    @endisset
    @error('name')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

