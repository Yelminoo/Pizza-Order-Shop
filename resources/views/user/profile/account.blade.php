@extends('user.layouts.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 offset-9">
                        <a href="{{ route('user#Home') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>

                <div class="col-lg-9 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">


                                <h3 class="text-center title-2">Account details</h3>

                            </div>
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
                            <hr>
                            <form action="{{ route('user#edit', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 ">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('image/female_default.png') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow-sm" alt="">
                                        @endif
                                        <input type="file" class="form-control my-3 " name="image">

                                        <button class="btn bg-dark text-light w-100" type="submit">Update</button>
                                    </div>


                                    <div class="col-7">


                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" type="text"
                                                value="{{ old('name', Auth::user()->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Name...">
                                        </div>
                                        @error('name')
                                            <div class="invalid_feeback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="email"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                class="form-control @error('email') is-invalid @enderror "
                                                placeholder="Email...">
                                        </div>
                                        @error('email')
                                            <div class="invalid_feeback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="text"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                class="form-control @error('phone') is-invalid @enderror "
                                                placeholder="Phone...">
                                        </div>
                                        @error('phone')
                                            <div class="invalid_feeback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Select...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female
                                                </option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid_feeback text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" value="" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="address..." cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                        </div>
                                        @error('address')
                                            <div class="invalid_feeback text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input name="role" type="text"
                                                value="{{ old('role', Auth::user()->role) }}" class="form-control "
                                                disabled placeholder="Role...">
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
