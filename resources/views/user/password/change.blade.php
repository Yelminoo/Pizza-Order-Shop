@extends('user.layouts.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('user#Home') }}"><button class="btn bg-dark text-white my-3">Home</button></a>
                    </div>
                </div>

                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                @if (session('notSame'))
                                    <div class="col-12 text-center">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>{{ session('notSame') }}</strong> .
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <h3 class="text-center title-2">Change password</h3>

                            </div>
                            <hr>
                            <form action="{{ route('user#changePassword') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Old password</label>
                                    <input name="oldPassword" type="password"
                                        class="form-control
                                     @error('oldPassword') is-invalid @enderror "
                                        placeholder="old password...">
                                </div>
                                @error('oldPassword')
                                    <div class=" text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror "
                                        placeholder="new passoword...">
                                </div>
                                @error('newPassword')
                                    <div class=" text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm password</label>
                                    <input name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror "
                                        placeholder="confirm password...">
                                </div>
                                @error('confirmPassword')
                                    <div class=" text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror

                                <div>
                                    <button type="submit" class="btn btn-lg btn-dark btn-block">
                                        <i class="fa-solid fa-key me-3"></i><span>Change</span>

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
