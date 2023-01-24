@extends('admin.layouts.master')
@section('title', 'Order list')
@section('dashboard', 'Order dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>


                    </div>
                </div>


                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <div class="row mb-3">
                            <div class="col-3 my-2">
                                <div class="">
                                    Search Key-{{ request('key') }}
                                </div>
                            </div>
                            <div class="offset-6 col-3 mt-1">
                                <form action="{{ route('order#listPage') }}" method="get" class=" d-flex ">
                                    <input type="text" name="key" class="form-control w-75 d-inline"
                                        value="{{ request('key') }}" placeholder="Search...">
                                    <button type="submit" class="btn bg-dark">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                </div>


                <div class="input-group">
                    <div class="input-group-append btn bg-dark text-light"><i class="fa-solid fa-clipboard-check mx-2"></i>
                        {{ $order->count() }}</div>
                    <form action="{{ route('admin#filterList') }}" method="get">
                        @csrf
                        <select class="custom-select orderStatus form-control col-3" id="inputGroupSelect04" name="status">
                            <option value="">ALL</option>
                            <option value="0" @if (request('status') == '0') selected @endif>Pending</option>
                            <option value="1" @if (request('status') == '1') selected @endif>Success</option>
                            <option value="2" @if (request('status') == '2') selected @endif>Reject</option>

                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                @if (count($order) != 0)



                    <thead class="text-center">

                        <tr>
                            <th class="col-2">User ID</th>
                            <th class="col-2">User Name</th>

                            <th class="col-2">Order date</th>
                            <th class="col-2">Order code</th>
                            <th class="col-2">Amount</th>
                            <th class="col-2">Status</th>

                        </tr>
                    </thead>
                    <tbody id='dataList'>



                        @foreach ($order as $o)
                            <tr class="tr-shadow text-center">
                                <input type="hidden" class="orderId" value="{{ $o->id }}">

                                <td class="col-1">{{ $o->user_id }}</td>
                                <td class="col-1">{{ $o->user_name }}</td>
                                <td class="col-2">{{ $o->created_at->format('j-F-Y') }}</td>
                                <td class="col-2"><a href="{{ route('order#detailsPage', $o->order_code) }} "
                                        class="text-danger text-decoration-none">{{ $o->order_code }}</a></td>
                                <td class="col-2">{{ $o->total_price }}</td>
                                <td>
                                    <select class="Status">

                                        <option value="0" @if ($o->status == 0) selected @endif>Pending...
                                        </option>
                                        <option value="1" @if ($o->status == 1) selected @endif>Success
                                        </option>
                                        <option value="2" @if ($o->status == 2) selected @endif>Reject
                                        </option>
                                    </select>
                                </td>


                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach





                    </tbody>
                @else
                    <h2 class="text-center mt-2 text-danger">There is no data</h2>

                @endif

                <div>


                </div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $('.orderStatus').change(function() {
            //     $status = $('.orderStatus').val();
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/order/ajax/filter/list',
            //         data: {
            //             'status': $status,
            //         },
            //         datatype: 'json',
            //         success: function(response) {
            //             // console.log(response.data);

            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {

            //                 $dbDate = new Date(response[$i].created_at);
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" + $dbDate.getFullYear();
            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                         <select class="Status">

        //                             <option value="0"selected>Pending...
        //                             </option>
        //                             <option value="1" >Success
        //                             </option>
        //                             <option value="2" >Reject
        //                             </option>
        //                         </select>
        //                 `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                         <select class="Status">

        //                             <option value="0">Pending...
        //                             </option>
        //                             <option value="1" selected >Success
        //                             </option>
        //                             <option value="2" >Reject
        //                             </option>
        //                         </select>
        //                 `;
            //                 } else if (response[$i].status == 2) {
            //                     $statusMessage = `
        //                         <select class="Status">

        //                             <option value="0">Pending...
        //                             </option>
        //                             <option value="1"  >Success
        //                             </option>
        //                             <option value="2" selected >Reject
        //                             </option>
        //                         </select>
        //                 `;
            //                 }
            //                 $list += `
        //             <tr class="tr-shadow text-center">
        //                 <input type="hidden" class="orderId" value="${response[$i].id}">

        //                 <td class="col-1">${response[$i].user_id}</td>
        //                 <td class="col-1">${response[$i].user_name}</td>
        //                 <td class="col-2">${$finalDate}</td>
        //                 <td class="col-2">${response[$i].order_code} </td>
        //                 <td class="col-2">${response[$i].total_price} </td>


        //                 <td>
        //                     ${$statusMessage}

        //                 </td>


        //             </tr>
        //             <tr class="spacer"></tr>

        //                     `;

            //             };

            //             $('#dataList').html($list);
            //         }

            //     })
            // });

            $('.Status').change(function() {
                $parentNode = $(this).parents('tr');
                $currentStatus = $(this).val();
                $orderId = $parentNode.find('.orderId').val();
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/update/status',
                    data: {
                        'status': $currentStatus,
                        'orderId': $orderId,

                    },
                    datatype: 'json',
                    success: function(response) {


                    }
                })
            })
        })
    </script>

@endsection
@endsection
