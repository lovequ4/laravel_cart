@extends("products.layout")
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Checkout</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="total">Total Price</label>
                            <input type="text" id="total" name="total" class="form-control" value="" readonly>
                        </div>

                        <div class="form-group" style="margin-top: 2%">
                            <label for="shipping_address">Shipping Address</label>
                            <input type="text" id="shipping_address" name="shipping_address" class="form-control">
                        </div>

                        <div class="form-group" style="margin-top: 2%">
                            <label for="billing_address">Billing Address</label>
                            <input type="text" id="billing_address" name="billing_address" class="form-control">
                        </div>

                        <div class="form-group" style="margin-top: 2%">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>

                        <div style="margin-top: 2%">
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const total = sessionStorage.getItem('totalPrice');

    const totalInput = document.getElementById('total'); 
    if (totalInput) {
        totalInput.value = total;
    }

</script>
@endsection
