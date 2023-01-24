@extends('admin.layouts.master')
@section('title', 'Product details Page')
@section('dashboard', 'Product dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 offset-9">
                        <a href="{{ route('product#listPage') }}"><i class="fa-solid fa-arrow-left btn"
                                onclick="history.back()"></i></a>
                    </div>
                </div>

                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">

                                <h3 class="text-center title-2"> details</h3>

                            </div>
                            <hr>
                            {{-- <div class="col-12">
                                @if (session('editSuccess'))
                                    <div class="">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <strong>{{ session('editSuccess') }}</strong> .
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div> --}}
                            <div class="row">

                                <div class="col-3 offset-1">

                                    <img src="{{ asset('storage/' . $product->image) }}" alt="">

                                </div>
                                <div class="col-8 w-100 fs-1">
                                    <h3 class=" my-1 btn bg-danger text-white text-center"><i
                                            class="fa-solid me-1 fa-pizza-slice "></i>{{ $product->name }}
                                    </h3>
                                    <span class=" my-1  btn bg-dark text-white"><i
                                            class="   me-2 fa-regular fa-envelope"></i>{{ $product->category_name }}
                                    </span>
                                    <span class=" my-1  btn bg-dark text-white"><i
                                            class="   me-2 fa-solid fa-money-bill-1-wave"></i>{{ $product->price }}
                                    </span>
                                    <span class=" my-1  btn bg-dark text-white"><i
                                            class="   me-2 fa-solid fa-clock"></i>{{ $product->waiting_time }}
                                    </span>
                                    <span class=" my-1  btn bg-dark text-white"><i
                                            class="   me-2 fa-solid fa-eye"></i>{{ $product->view_count }}
                                    </span>

                                    <span class=" my-1  btn bg-dark text-white"><i
                                            class="   me-2 fa-solid fa-user-clock"></i>{{ $product->created_at->format('j-F-Y') }}
                                    </span>
                                    <br>
                                    <div class="my-1   btn bg-dark text-white">
                                        <i class=" me-2 fa-solid fa-file-invoice"></i>
                                    </div>
                                    <div class="fs-5">{{ $product->description }}</div>


                                </div>

                                <div class="row mt-5">
                                    <a href="{{ route('product#edit', $product->id) }}">
                                        <button type="btn" class="btn btn-lg btn-info btn-block">
                                            <i class="fa-solid fa-pen-to-square"></i><span>Edit</span>

                                        </button>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
