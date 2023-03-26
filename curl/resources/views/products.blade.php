<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <div>
        @foreach($products as $product)
        <div>
            <h2>{{ $product['title'] }}</h2>
            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}">
            <p>Price: {{ $product['price'] }}</p>
        </div>
        @endforeach
    </div>
</body>
</html>
