<h1>Create Product</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
    <textarea name="description" placeholder="Description">{{ old('description') }}</textarea>
    <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price') }}">
    <input type="file" name="cover_image">
    <input type="file" name="images[]" multiple>
    <button type="submit">Save</button>
</form>
