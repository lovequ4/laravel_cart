@extends("products.layout")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div>
            <h1 class="title" style="font-weight: bold;">MyCarts</h1>
        </div>
      
        <!-- Table -->
        <div class="table-responsive">
            <table class="table" style="background-color: white;margin-top: 2%">
                <thead class="table-light">
                    <tr style="text-align: center">
                        <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                    <tr>
                        <td style="height: 100px;" align="center" valign="middle">
                            <input type="checkbox" class="product-checkbox" data-price="{{ $cartItem->price }}" value="{{ $cartItem->id }}">
                        </td>
                        
                        <td style="text-align: center">
                            <img src="{{ $cartItem->product->thumbnail }}">
                        </td>
                        <td style="height:100px;" align='center' valign="middle">{{ $cartItem->product->name }}</td>
                        <td style="height:100px;" align='center' valign="middle">${{$cartItem->price }}</td>
                        <td style="height:100px;" align='center' valign="middle">{{ $cartItem->quantity }}</td>
                        
                        <td style="height:100px;" align='center' valign="middle">
                            <div class="btn-group" role="group">
                                <form action="{{ route('carts.remove', ['id' => $cartItem->id]) }}" method="post">
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
        
        <div >
                Total Price: <span id="total-price">$0</span>
            <form method="GET" action="{{route('orders.create')}}" style="margin-top: 2%">
                @csrf
                <input type="hidden" name="total" value="0.00">
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
        
    </div>
</div>

<script>
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const totalSpan = document.getElementById('total-price');
    const checkoutButton = document.getElementById('checkout-button');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotal);
    });

    function updateTotal() {
        let totalPrice = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
            }
        });

        totalSpan.textContent = '$' + totalPrice;
        const totalInput = document.querySelector('input[name="total"]');
        if (totalInput) {
            totalInput.value = totalPrice;
        }

        sessionStorage.setItem('totalPrice', totalPrice);
        
        console.log('Total price in session: ' + sessionStorage.getItem('totalPrice'));

    }

   
</script>

@endsection
