@extends("admin.layout")
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div>
            <h1 class="title" style="font-weight: bold;">Products</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
        </div>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table" style="background-color: white;margin-top: 2%">
                <thead class="table-light">
                    <tr style="text-align: center">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td style="text-align: center">
                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" >
                        </td>
                        <td style="height:100px;" align='center' valign="middle">{{ $product->name }}</td>
                        <td style="height:100px;" align='center' valign="middle">{{ $product->description }}</td>
                        <td style="height:100px;" align='center' valign="middle">${{ $product->price }}</td>
                        <td style="height:100px;" align='center' valign="middle">{{ $product->quantity }}</td>
                        
                        <td style="height:100px;" align='center' valign="middle">
                            <div class="btn-group" role="group">
                                <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-warning" style="margin-right: 2%">Edit</a>
                                <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
