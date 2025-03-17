<h1>Edit Product</h1>
<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf @method('PUT')
    <input type="text" name="name" placeholder="Name" value="{{ old('name', $product->name) }}">
    <textarea name="description" placeholder="Description">{{ old('description', $product->description) }}</textarea>
    <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price', $product->price) }}">
    <button type="submit">Update</button>
</form>
