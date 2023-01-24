@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    @if (count($cart) != 0)
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($cart as $c)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $c->image) }}" alt="" style="height: 100px;"
                                            class="img-thumbnail shadow-sm"></td>
                                    <td class="align-middle">
                                        {{ $c->pizza_name }}
                                        <input type="hidden" id='cart_id' value="{{ $c->id }}">

                                        <input type="hidden" id="user_id" value="{{ $c->user_id }}">
                                        <input type="hidden" id="product_id" value="{{ $c->product_id }}">
                                    </td>
                                    <td class="align-middle" id="price">{{ $c->pizza_price }}</td>
                                    <td class="align-middle">

                                        <div class="input-group quantity mx-auto" style="width: 100px;">

                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" type="button">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $c->qty }}" id='qty'>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm bg-primary btn-plus" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle col-3" id="total">{{ $c->pizza_price * $c->qty }}kyats</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger remove"><i
                                                class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach


                        </tbody>
                    @else
                        <h2 class="text-center mt-2 text-danger">There is no data</h2>
                    @endif

                </table>
                <div>
                    {{ $cart->links() }}
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="totalPrice">{{ $total }}kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalAll">{{ $total + 3000 }}kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 addOrder">Proceed To
                            Checkout</button>

                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 removeOrder">Cancel all
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.addOrder').click(function() {
                $orderList = [];
                $random = Math.floor(Math.random() * 10000000001);
                $('#dataTable tbody tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': $(row).find('#user_id').val(),
                        'product_id': $(row).find('#product_id').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#total').text().replace('kyats', '') * 1,
                        'order_code': 'POS' + $random,
                    });
                })
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/addOrderList',
                    data: Object.assign({}, $orderList),
                    datatype: 'json',
                    success: function(response) {
                        if (response.status == 'true') {
                            window.location.href = "/user/home";
                        }
                    }

                })





            })
            $('.removeOrder').click(function() {

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/removeAllCart',
                    datatype: 'json',

                });
                $('#dataTable tbody tr').remove();
                $('#totalPrice').html('0kyats');
                $('#totalAll').html('3000 kyats');
            })
            //   $('.remove').click(function() {
            //     $parentNode = $(this).parents('tr');
            //     $parentNode.remove();
            // })

            $('.remove').click(function() {
                $cartId = $('#cart_id').val();
                $(this).parents('tr').remove();
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/removeCart',
                    data: {
                        'cart_id': $cartId
                    },
                    datatype: 'json',

                })
                $totalPrice = 0;
                $("#dataTable tr").each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("kyats",
                        ""));
                });

                $("#totalPrice").html(`${$totalPrice} kyats`);
                $('#totalAll').html($totalPrice + 3000 + 'kyats');



            })
        })
    </script>
@endsection

@endsection
