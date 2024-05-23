<!DOCTYPE html>
<html>
<head>
    <title>Variant Details</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .product { margin-bottom: 20px; }
        .product h2 { margin: 0; }
        .product .description { margin: 10px 0; }
        .product .price { color: green; }
    </style>
</head>
<body>
    <h1>Product Details</h1>
    @foreach($variants as $variant)
        <div class="variants">
            <h1> {{ 'Product Name: '.$variant->product->name }}</h1>
            <h2>{{ 'Variant Name: '.$variant->name }}</h2>
            <div class="price">{{ 'Variant Price: '.number_format($variant->price, 2) }}</div>
        </div>
    @endforeach
</body>
</html>
