<h1>Create Product</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
    <textarea name="description" placeholder="Description">{{ old('description') }}</textarea>
    <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price') }}">
    <button type="submit">Save</button>
</form>
