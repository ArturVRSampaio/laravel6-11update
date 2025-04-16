
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

<div class="form-group">
    <label for="description">Description</label>
    @isset($item)
        <textarea id="description" name="description">{{ old('description', $item->description) }}</textarea>
    @else
        <textarea id="description" name="description">{{ old('description') }}</textarea>
    @endisset
    @error('description')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="quantity">Quantity</label>
    @isset($item)
    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $item->quantity) }}" min="1" required>
    @else
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
    @endisset
    @error('quantity')
    <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="price">Price</label>
    @isset($item)
        <input type="number" id="price" name="price" value="{{ old('price', $item->price) }}" min="0" step="0.01" required>
    @else
        <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required>
    @endisset
    @error('price')
    <div class="error">{{ $message }}</div>
    @enderror
</div>
