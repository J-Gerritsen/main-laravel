@include('partials.header')

<div>
    <h1>{{ $product->name }}</h1>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <div>
        <h2>Images</h2>
        @if($product->cover_image)
            <img src="{{ asset($product->cover_image) }}" alt="Cover Image" style="width: 300px; height: auto;">
        @endif

        @if(!empty($product->images) && is_array($product->images))
            <div>
                @foreach($product->images as $image)
                    <img src="{{ asset($image) }}" alt="Product Image" style="width: 150px; height: auto;">
                @endforeach
            </div>
        @else
            <p>No additional images available.</p>
        @endif
    </div>
    <div>
        <h2>Add to Cart</h2>
        <form action="{{ route('cart.add', $product) }}" method="POST">
            @csrf
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>

    <a href="{{ route('products.store') }}">Back to Products</a>
</div>
