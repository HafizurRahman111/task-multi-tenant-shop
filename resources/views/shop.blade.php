<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ $store->name }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* General Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        .store-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        .store-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
            animation: slideInDown 0.8s ease-in-out;
        }

        .store-header h2 {
            font-size: 1.5rem;
            font-weight: 400;
            animation: slideInUp 0.8s ease-in-out;
        }

        /* Category Section */
        .category-section {
            margin-bottom: 40px;
            animation: fadeIn 1s ease-in-out;
        }

        .category-section h3 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #007bff;
            display: inline-block;
        }

        /* Product Card Styles */
        .product-card {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
            animation: fadeInUp 0.8s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .product-card .card-body {
            padding: 15px;
            text-align: center;
        }

        .product-card h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .product-card p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .product-card .price {
            font-size: 1rem;
            color: #28a745;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-card .stock {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .product-card .stock.in-stock {
            color: #007bff;
        }

        .product-card .stock.out-of-stock {
            color: #dc3545;
        }

        .product-card .text-muted {
            font-size: 0.8rem;
        }


        /* No Data Message */
        .no-data {
            text-align: center;
            color: #6c757d;
            font-size: 1.1rem;
            margin-top: 20px;
        }

        /* Grid Layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding: 10px;
            box-sizing: border-box;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .store-header h1 {
                font-size: 2rem;
            }

            .store-header h2 {
                font-size: 1.25rem;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Store Header -->
        <div class="store-header">
            <h1>Welcome to {{ $store->name }}</h1>
            <h2>Explore our wide range of products and categories</h2>
        </div>

        <!-- Categories and Products -->
        @if($categories->isEmpty())
            <p class="no-data">No categories available.</p>
        @else
            @foreach ($categories as $category)
                <div class="category-section">
                    <h3>{{ $category->name }}</h3>
                    @if ($category->products->isEmpty())
                        <p class="no-data">No products available in this category.</p>
                    @else
                        <div class="row">
                            @foreach ($category->products as $product)
                                <div class="col-md-3">
                                    <div class="card product-card">
                                        <img src="{{ $product->image ? asset('assets/images/products/' . $product->image) : asset('assets/images/default/no-image-available.jpg') }}"
                                            class="card-img-top" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5>{{ $product->name }}</h5>
                                            <p class="price">${{ number_format($product->price, 2) }}</p>
                                            <p class="text-muted">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                                            <p class="stock {{ $product->stock < 1 ? 'out-of-stock' : 'in-stock' }}">
                                                {{ $product->stock < 1 ? 'Out of Stock' : 'In Stock: ' . $product->stock }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</body>

</html>