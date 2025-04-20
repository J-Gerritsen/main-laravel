@include('partials.header')

<h1>Products</h1>
<a href="{{ route('products.create') }}">Create new product</a>

<table>
    <thead>
    <tr>
        <th>Cover</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Gallery</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>
                @if($product->cover_image)
                    <img src="{{ asset($product->cover_image) }}" loading="lazy" alt="Cover Image" style="width: 100px; height: auto;">
                @else
                    <p>No cover image</p>
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>
                @if(!empty($product->images) && is_array($product->images))
                    <div style="display: flex; gap: 5px;">
                        @foreach($product->images as $image)
                            <img src="{{ asset($image) }}" loading="lazy" alt="Gallery Image" style="width: 100px; height: auto;">
                        @endforeach
                    </div>
                @else
                    <p>No images</p>
                @endif
            </td>
            <td>
                <a href="{{ route('products.edit', $product) }}">Edit</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
