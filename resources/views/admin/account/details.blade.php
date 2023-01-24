@extends('admin.layouts.master')
@section('title', 'Account details Page')
@section('dashboard', 'Admin dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 offset-9">
                        <a href="{{ route('admin#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>

                <div class="col-lg-9 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">

                                <h3 class="text-center title-2">Account details</h3>

                            </div>
                            <hr>
                            <div class="col-12">
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
                            </div>
                            <div class="row">

                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img class="img-thumbnail shadow-sm"
                                                src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                alt="">
                                        @else
                                            <img class="img-thumbnail shadow-sm"src="{{ asset('image/female_default.png') }}"
                                                alt="">
                                        @endif
                                    @else
                                        <img class="img-thumbnail shadow-sm"
                                            src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                                    @endif
                                </div>
                                <div class="col-7">
                                    <h4 class="my-3"><i
                                            class="me-3  fa-regular fa-circle-user"></i>{{ Auth::user()->name }}
                                    </h4>
                                    <h4 class="my-3"><i class="me-3  fa-regular fa-envelope"></i>{{ Auth::user()->email }}
                                    </h4>
                                    <h4 class="my-3"><i class="me-3  fa-solid fa-phone"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class="my-3"><i
                                            class="me-3  fa-solid fa-location-dot"></i>{{ Auth::user()->address }}
                                    </h4>
                                    <h4 class="my-3"><i class="fa-solid fa-mars-and-venus"></i>{{ Auth::user()->gender }}
                                    </h4>


                                    <h4 class="my-3"><i
                                            class="me-3  fa-regular fa-calendar-days"></i>{{ Auth::user()->created_at->format('j- F -Y') }}
                                    </h4>
                                    <h4 class="my-3"><i class="me-3  fa-solid fa-user-check"></i>{{ Auth::user()->role }}
                                    </h4>
                                </div>

                                <div class="row mt-5">
                                    <a href="{{ route('admin#edit') }}">
                                        <button type="btn" class="btn btn-lg btn-info btn-block">
                                            <i class="me-3  fa-solid fa-user-pen"></i><span>Edit</span>

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
