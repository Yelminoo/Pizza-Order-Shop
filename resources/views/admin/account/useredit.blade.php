@extends('admin.layouts.master')
@section('title', 'User edit Page')
@section('dashboard', 'User dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 offset-9">
                        <a href="{{ route('user#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>

                <div class="col-lg-9 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">


                                <h3 class="text-center title-2">User's Account Edit Page</h3>

                            </div>
                            <hr>
                            <form action="{{ route('user#editByAdmin', $user[0]->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 ">
                                        @if ($user[0]->image == null)
                                            @if ($user[0]->gender == 'male')
                                                <img src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('image/female_default.png') }}"
                                                    class="img-thumbnail shadow-sm"alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $user[0]->image) }}"
                                                class="img-thumbnail shadow-sm"alt="">
                                        @endif
                                        <input type="file"
                                            class="form-control my-3  @error('image') is-invalid @enderror" name="image">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <button class="btn bg-dark text-light w-100" type="submit">Update</button>
                                    </div>


                                    <div class="col-7">


                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input name="name" type="text" value="{{ old('name', $user[0]->name) }}"
                                                class="form-control" placeholder="Name...">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input name="email" type="email" value="{{ old('email', $user[0]->email) }}"
                                                class="form-control " placeholder="Email...">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input name="phone" type="text" value="{{ old('phone', $user[0]->phone) }}"
                                                class="form-control " placeholder="Phone...">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Select...</option>
                                                <option value="male" @if ($user[0]->gender == 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if ($user[0]->gender == 'female') selected @endif>
                                                    Female
                                                </option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid_feeback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" value="" class="form-control" placeholder="address..." cols="30" rows="10">{{ old('address', $user[0]->address) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input name="role" type="text"
                                                value=" {{ old('role', $user[0]->role) }} " class="form-control " disabled
                                                placeholder="Role...">
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
