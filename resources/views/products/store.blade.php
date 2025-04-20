@include('partials.header')

@foreach($categories as $category)
    <h2>{{ $category->name }}</h2>

    @if($category->products->count())
        <div
            style="display: flex; flex-wrap: wrap;">
            @foreach($category->products as $product)
                <a href="{{ route('product.show', $product->id) }}">
                <div
                    style="width: 200px;">
                    @if($product->cover_image)
                        <img src="{{ asset($product->cover_image) }}" alt="Cover" style="width: 100%; height: auto;">
                    @endif
                    <h3>{{ $product->name }}</h3>
                    <p>Price: ${{ $product->price }}</p>
                </div>
                </a>
            @endforeach
        </div>
    @else
        <p>No products in this category.</p>
    @endif
@endforeach
