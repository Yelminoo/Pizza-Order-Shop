@extends('user.layouts.master')
@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <a href="{{ route('user#Home') }}" class="text-dark text-decoration-none">
                <i class="fa-solid fa-arrow-left my-3 "></i>back
            </a>
            <div class="col-lg-5 mb-30">

                <img src="{{ asset('storage/' . $p->image) }}" alt="" class="img-thumbnail shadow w-100"
                    style="height: 450px">

            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $p->name }}</h3>
                    <div class="d-flex mb-3">
                        {{-- <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div> --}}
                        <small class="pt-1"><i class="fa-solid fa-eye me-2"></i>{{ $p->view_count + 1 }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $p->price }}kyats</h3>
                    <p class="mb-4">{{ $p->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="productId" class="productId" value="{{ $p->id }}">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="order"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addCart" class="btn btn-primary px-3"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                    class="img-thumbnail shadow" style="height: 250px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#details', $p->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }}kyats</h5>

                                </div>
                                {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
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
            console.log($('#productId').val());
            $.ajax({
                type: 'get',
                url: '/user/ajax/increaseViewCount',
                data: {
                    'product_id': $('#productId').val()
                },
                datatype: 'json',


            })





            $('#addCart').click(function() {
                $userId = $('#userId').val();
                $pizzaId = $('#productId').val();
                $count = $('#order').val();
                $data = {
                    user: $userId,
                    pizzaId: $pizzaId,
                    count: $count,
                };
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/addToCart',
                    data: $data,
                    datatype: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "/user/home";

                        }

                    }

                })
            })

        })
    </script>
@endsection
@endsection
