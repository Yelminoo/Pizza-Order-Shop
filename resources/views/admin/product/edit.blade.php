@extends('admin.layouts.master')
@section('title', 'edit Page')
@section('dashboard', 'Product dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">

                </div>

                <div class="col-lg-9 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="col-lg-3 ">
                                    <i class="fa-solid fa-arrow-left btn " onclick="history.back()"></i>
                                </div>



                                <h3 class="text-center title-2">Edit</h3>

                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                </div>
                                <div class="row">
                                    <div class="col-4 ">

                                        <img src="{{ asset('storage/' . $pizza->image) }}" alt="">

                                        <input type="file"
                                            class="form-control my-3  @error('pizzaImage') is-invalid @enderror"
                                            name="pizzaImage">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <button class="btn bg-dark text-light w-100" type="submit">Update</button>
                                    </div>


                                    <div class="col-7">


                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="pizzaName" type="text"
                                                value="{{ old('pizzaName', $pizza->name) }}"
                                                class="form-control @error('pizzaName') is-invalid @enderror"
                                                placeholder="Name...">
                                        </div>
                                        @error('pizzaName')
                                            <div class="invalid_feeback">
                                                {{ $message }}
                                            </div>
                                        @enderror


                                        <div class="form-group">
                                            <label class="control-label mb-1">description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30"
                                                rows="10">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                        </div>
                                        @error('pizzaDescription')
                                            <div class="invalid_feeback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input name="pizzaPrice" type="number"
                                                value="{{ old('pizzaPrice', $pizza->price) }}"
                                                class="form-control @error('pizzaPrice') is-invalid @enderror "
                                                placeholder="Price...">
                                            @error('pizzaPrice')
                                                <div class="invalid_feeback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label class="control-label mb-1">Category id</label>
                                                <select name="categoryId"
                                                    class="form-control @error('categoryId') is-invalid @enderror">
                                                    <option value="">Select...</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id }} "
                                                            @if ($pizza->category_id == $c->id) selected @endif>
                                                            {{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('categoryId')
                                                    <div class="invalid_feeback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">waitingTime</label>
                                                <input name="waitingTime"
                                                    value="{{ old('waitingTime', $pizza->waiting_time) }}" type="number"
                                                    class="form-control @error('waititngTime') is-invalid @enderror"></input>
                                            </div>
                                            @error('waitingTime')
                                                <div class="invalid_feeback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label class="control-label mb-1">View count</label>
                                                <input value="{{ $pizza->view_count }}" type="number" class="form-control"
                                                    disabled></input>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Date </label>
                                                <input type="datetime" value="{{ $pizza->created_at->format('j-F-Y') }}"
                                                    class="form-control " disabled>
                                            </div>

                            </form>
                        </div>



                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
