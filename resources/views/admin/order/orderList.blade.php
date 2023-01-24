@extends('admin.layouts.master')
@section('title', 'Order Details')
@section('dashboard', 'Order dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 offset-9">
                        <a href="{{ route('order#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order Details</h2>

                            </div>
                        </div>


                    </div>
                    <div class="row col-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Order Details</h3>
                                <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-1"></i>Delivery
                                    fees included</small>
                            </div>
                            <div class="card-body ">
                                <div class="row mb-2">
                                    <div class="col-6"><i class="fa-solid me-2 fa-user"></i>User Name</div>
                                    <div class="col-6">{{ $order[0]->user_name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6"><i class="fa-solid me-2 fa-barcode"></i>User Code</div>
                                    <div class="col-6">{{ $order[0]->order_code }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6"><i class="fa-regular  me-2 fa-calendar"></i>Order Date</div>
                                    <div class="col-6">{{ $order[0]->created_at->format('j-F-Y') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6"><i class="fa-solid me-2 fa-money-bills"></i>Total</div>
                                    <div class="col-6">{{ $total[0]->total_price }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2">


                        <thead class="text-center
                        ">
                            <tr>
                                <th class="col-2">User ID</th>
                                <th class="col-2">Product name </th>
                                <th class="col-2">Product image</th>

                                <th class="col-2">Qty</th>

                                <th class="col-2">Amount</th>


                            </tr>
                        </thead>
                        <tbody id='dataList'>



                            @foreach ($order as $o)
                                <tr class="tr-shadow text-center">
                                    <input type="hidden" class="orderId" value="{{ $o->id }}">

                                    <td class="col-1">{{ $o->user_id }}</td>
                                    <td class="col-1">{{ $o->product_name }}</td>
                                    <td class="col-2"><img src="{{ asset('storage/' . $o->product_image) }}"
                                            class="img-thumbnail shadow-sm" alt=""></td>
                                    <td class="col-2">{{ $o->qty }}</td>

                                    <td class="col-2">{{ $o->total }}</td>



                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach





                        </tbody>
                    </table>

                    <div>


                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
