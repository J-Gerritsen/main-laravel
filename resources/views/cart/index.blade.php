@include('partials.header')

<h1>Your Cart</h1>

@if ($cartItems->isEmpty())
    <p>Your cart is empty.</p>
@else
    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button type="submit">Clear Cart</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price Each</th>
            <th>Subtotal</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @php $total = 0; @endphp

        @foreach ($cartItems as $product)
            @php
                $subtotal = $product->price * $product->pivot->quantity;
                $total += $subtotal;
            @endphp

            <tr>
                <td>{{ $product->name }}</td>
                <td>
                    <form action="{{ route('cart.update', $product) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="0">
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ number_format($subtotal, 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $product) }}" method="POST">
                        @csrf
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p>Total: {{ number_format($total, 2) }}</p>
@endif
