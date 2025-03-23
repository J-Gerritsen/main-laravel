<h1>Edit Product</h1>
<form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @if($product->cover_image)
        <img src="{{ asset($product->cover_image) }}" alt="Cover Image" style="width: 100px; height: auto;">
    @else
        <p>No cover image available</p>
    @endif
    <input type="file" name="cover_image">
    <input type="text" name="name" placeholder="Name" value="{{ old('name', $product->name) }}">
    <textarea name="description" placeholder="Description">{{ old('description', $product->description) }}</textarea>
    <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price', $product->price) }}">
    @if(!empty($product->images) && is_array($product->images))
        <div style="display: flex; gap: 10px;">
            @foreach($product->images as $image)
                <div>
                    <img src="{{ asset($image) }}" alt="Gallery Image" style="width: 100px; height: auto;">
                    <input type="file" name="images[]" multiple>
                </div>
            @endforeach
        </div>
    @else
        <p>No additional images available</p>
    @endif
    <button type="submit">Update</button>
</form>
