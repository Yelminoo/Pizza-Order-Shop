@extends('admin.layouts.master')
@section('title', 'CreateProductPage')
@section('dashboard', 'Product dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#listPage') }}"><button
                                class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Category Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Product Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text"
                                        class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Write product Name...">
                                </div>
                                @error('pizzaName')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category Id</label>
                                        <select name="categoryId" class="form-control">
                                            <option value="">Choose category</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @error('categoryId')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescripiton') is-invalid @enderror"></textarea>
                                            @error('pizzaDescription')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">image</label>
                                                    <input type="file" name="pizzaImage" class="form-control">
                                                </div>
                                                @error('pizzaImage')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <div>
                                                    <div class="form-group">
                                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                                        <input id="cc-pament" name="pizzaPrice" type="number"
                                                            class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                            aria-required="true" aria-invalid="false"
                                                            placeholder="Price...">
                                                    </div>
                                                    @error('pizzaPrice')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                    <div>
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">Waiting
                                                                time</label>
                                                            <input id="cc-pament" name="waitingTime" type="number"
                                                                class="form-control @error('waitingTime') is-invalid @enderror"
                                                                aria-required="true" aria-invalid="false"
                                                                placeholder="waiting time...">
                                                        </div>
                                                        @error('waitingTime')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror


                                                        <div>
                                                            <button id="payment-button" type="submit"
                                                                class="btn btn-lg btn-info btn-block">
                                                                <span id="payment-button-amount">Create</span>

                                                            </button>
                                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
