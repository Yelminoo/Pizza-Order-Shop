@extends('admin.layouts.master')
@section('title', 'Contact details Page')
@section('dashboard', 'Contact dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 offset-9">
                        <a href="{{ route('contact#historyPage') }}"><button
                                class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">

                                <h3 class="text-center title-2">Contact details</h3>

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

                                <div class="col-2 offset-1">
                                    @if ($c->user_image == null)
                                        @if ($c->user_gender == 'male')
                                            <img src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('image/female_default.png') }}" alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . $c->user_image) }}" alt="">
                                    @endif
                                </div>
                                <div class="col-7">
                                    <h4 class="my-3"><i class="me-3  fa-regular fa-circle-user"></i>{{ $c->name }}
                                    </h4>
                                    <h4 class="my-3"><i class="me-3  fa-regular fa-envelope"></i>{{ $c->email }}
                                    </h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope-open-text"></i> <br>
                                        <textarea id="" cols="28" rows="10" class="border p-2">{{ $c->message }}</textarea>
                                    </h4>




                                    <h4 class="my-3"><i
                                            class="me-3  fa-regular fa-calendar-days"></i>{{ $c->created_at->format('j- F -Y') }}
                                    </h4>

                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
