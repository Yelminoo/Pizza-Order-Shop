@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by Category</span></h5>
                <div class="bg-light  p-4 mb-30">
                    <form>
                        <div class=" bg-dark text-light m-3 p-2  d-flex align-items-center justify-content-between  ">

                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>
                        <div class=" d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('user#Home') }}" class="text-dark text-decoration-none">All</a>

                        </div>


                        @foreach ($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3 ">

                                <a href="{{ route('user#filter', $c->id) }}"
                                    class="text-dark text-decoration-none">{{ $c->name }}</a>

                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->




                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>

                                <a href="{{ route('user#cartList') }}" class="text-decoration-none me-2">
                                    <button type="button"
                                        class="btn bg-dark text-white border rounded my-3 position-relative">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}

                                        </span>
                                    </button>
                                </a>

                                <a href="{{ route('user#orderList') }}" class="text-decoration-none">
                                    <button type="button"
                                        class="btn bg-dark text-white border rounded my-3 position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}

                                        </span>
                                    </button>
                                </a>
                            </div>


                            <div class="ml-2">
                                <div class="btn-group">
                                    {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div> --}}
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <span class="row" id="datalist">
                        @if (count($products) != 0)
                            @foreach ($products as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:210px ;"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <input type="hidden" class="userId" value="{{ Auth::user()->id }}">
                                                <input type="hidden" class="productId" value="{{ $p->id }}">
                                                <a class="btn btn-outline-dark btn-square" href=""><button
                                                        class="addCart btn w-100 "><i
                                                            class="fa fa-shopping-cart "></i></button></a>
                                                <a class="btn btn-outline-dark btn-square "
                                                    href="{{ route('user#details', $p->id) }}">


                                                    <i class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>
                                                <h6 class="text-muted ml-2"></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="fs-5 my-3 text-center p-2 text-danger">There is no data<i
                                    class="fa-solid fa-pizza-slice ms-2"></i></div>
                        @endif
                    </span>



                </div>
            @section('scriptSource')
                <script>
                    $(document).ready(function() {
                        // $.ajax({
                        //     type: 'get',
                        //     url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        //     datatype: 'json',
                        //     success: function(response) {
                        //         console.log(response)
                        //     }
                        // })





                        //add to cart
                        $('.addCart').click(function() {
                            $parentNode = $(this).parents('div .product-action')
                            $userId = $parentNode.find('.userId').val();

                            $pizzaId = $parentNode.find('.productId').val();
                            console.log($pizzaId);
                            $count = 1
                            $data = {
                                user: $userId,
                                pizzaId: $pizzaId,
                                count: $count,
                            };
                            console.log($data)
                            $.ajax({
                                type: 'get',
                                url: '/user/ajax/addToCart',
                                data: $data,
                                datatype: 'json',
                                success: function(response) {
                                    if (response.status == 'success') {
                                        window.location.href = "/user/home";
                                        window.location.reload();

                                    }

                                }

                            })
                        })

                        //sorting order

                        $('#sortingOption').change(function() {
                            $eventOption = $('#sortingOption').val();

                            if ($eventOption == 'asc') {
                                $.ajax({
                                    type: 'get',
                                    url: '/user/ajax/pizza/list',
                                    data: {
                                        'status': 'asc'
                                    },
                                    datatype: 'json',
                                    success: function(response) {
                                        $list = '';
                                        for ($i = 0; $i < response.length; $i++) {
                                            $list += `
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height:210px ;"
                                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                                class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                                class="fa-solid fa-circle-info"></i></a>

                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                        <h5>${response[$i].price}</h5>
                                                        <h6 class="text-muted ml-2"></h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        `;

                                        }
                                        $('#datalist').html($list);


                                    }
                                })

                            } else if ($eventOption == 'desc') {
                                $.ajax({
                                    type: 'get',
                                    url: '/user/ajax/pizza/list',
                                    data: {
                                        'status': 'desc'
                                    },
                                    datatype: 'json',
                                    success: function(response) {
                                        $list = '';
                                        for ($i = 0; $i < response.length; $i++) {
                                            $list += `
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <div class="product-item bg-light mb-4">
                                                <div class="product-img position-relative overflow-hidden">
                                                    <img class="img-fluid w-100" style="height:210px ;"
                                                        src="{{ asset('storage/${response[$i] . image}') }}" alt="">
                                                    <div class="product-action">
                                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                                class="fa fa-shopping-cart"></i></a>
                                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                                class="fa-solid fa-circle-info"></i></a>

                                                    </div>
                                                </div>
                                                <div class="text-center py-4">
                                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5> ${response[$i].price} </h5>
                                                        <h6 class="text-muted ml-2"></h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    `;

                                        }
                                        $('#datalist').html($list);
                                    }
                                })
                            }
                        })
                    })
                </script>
            @endsection
        @endsection
