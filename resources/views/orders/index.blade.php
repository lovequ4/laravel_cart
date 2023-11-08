@extends("products.layout")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            <h1 class="title" style="font-weight: bold;">Order List</h1>
            <table class="table" style="background-color: white; margin-top: 2%">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Shipping Address</th>
                        <th>Billing Address</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders  as $index => $order)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->billing_address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>${{ $order->total }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
