@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid " style="height:400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5 offset-2">
                <table class="table table-light table-borderless table-hover text-center mb-3" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Ordercode</th>
                            <th>Userid</th>
                            <th>Total price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>

                                <td class="align-middle">{{ $o->created_at->format('j-F-Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->user_id }}</td>
                                <td class="align-middle">{{ $o->total_price }}</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <span class="text-warning"><i
                                                class="fa-solid fa-hourglass-start me-1"></i>Pending...</span>
                                    @elseif($o->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check me-1"></i>Success</span>
                                    @elseif($o->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-xmark me-1"></i> reject</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $order->links() }}

            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
