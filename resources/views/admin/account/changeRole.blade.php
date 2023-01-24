@extends('admin.layouts.master')
@section('title', 'Account change role Page')
@section('dashboard', 'Admin dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    class="img-thumbnail shadow-sm"
                </div>

                <div class="col-lg-9 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="col-lg-3 ">
                                    <i class="fa-solid fa-arrow-left btn " onclick="history.back()"></i>
                                </div>


                                <h3 class="text-center title-2">Account details</h3>

                            </div>
                            <hr>
                            <form action="{{ route('admin#change') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div>
                                            <input type="hidden" name="id" value="{{ $admin->id }}">
                                        </div>
                                        @if ($admin->image == null)
                                            @if ($admin->gender == 'male')
                                                <img src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('image/female_default.png') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $admin->image) }}"
                                                class="img-thumbnail shadow-sm" alt="">
                                        @endif


                                        <button class="btn bg-dark text-light w-100 my-2" type="submit">Change</button>
                                    </div>


                                    <div class="col-7">


                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" type="text" value="{{ $admin->name }}"
                                                class="form-control" placeholder="Name..." disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role" id="" class="form-control">

                                                <option value="admin" @if ($admin->role == 'admin') selected @endif>
                                                    Admin
                                                </option>
                                                <option value="user" @if ($admin->role == 'user') selected @endif>
                                                    User
                                                </option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="email" value="{{ old('email', $admin->email) }}"
                                                class="form-control " placeholder="Email..." disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="text" value="{{ old('phone', $admin->phone) }}"
                                                class="form-control " placeholder="Phone..." disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror" disabled>
                                                <option value="">Select...</option>
                                                <option value="male" @if ($admin->gender == 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if ($admin->gender == 'female') selected @endif>
                                                    Female
                                                </option>
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" value="" class="form-control" placeholder="address..." cols="30" disabled
                                                rows="10">{{ old('address', $admin->address) }}</textarea>
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
