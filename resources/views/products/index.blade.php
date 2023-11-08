@extends("products.layout")
@section('content')
<div class="container mt-6">

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product->image  }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        
                        <form method="POST" action="{{ route('carts.add', ['productId' => $product->id]) }}">
                            @csrf
                            <div class="input-group">
                                <input type="number" name="quantity" value="1" min="1" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
