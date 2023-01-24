@extends('admin.layouts.master')
@section('title', 'Contact History')
@section('dashboard', 'Contact History dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact History</h2>

                            </div>
                        </div>


                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong> .
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <div class="d-inline my-2">
                                <span>
                                    Search Key- {{ request('key') }}
                                </span>
                            </div>
                            <div class="offset-8">
                                <form action="{{ route('contact#historyPage') }}" method="get" class=" d-flex ">
                                    <input type="text" name="key" class="form-control w-75 d-inline"
                                        value="{{ request('key') }}" placeholder="Search...">
                                    <button type="submit" class="btn bg-dark">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 d-line">
                                <div class="btn bg-dark text-light">
                                    <i class="fa-solid fa-clipboard-check mx-2"></i>
                                    {{ $contact->total() }}

                                </div>
                            </div>
                            @if (count($contact) != 0)

                                <thead>
                                    <tr class="text-center">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>

                                        <th>Address</th>
                                        <th>Phone</th>

                                        <th>Message</th>
                                        <th>Gender</th>


                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                    @foreach ($contact as $c)
                                        <tr class="tr-shadow">

                                            <td class=" col-1">
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
                                            </td>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->email }}</td>

                                            <td>{{ $c->user_address }}</td>
                                            <td>{{ $c->user_phone }}</td>



                                            <td class="overflow-hidden">{{ $c->message }}</td>
                                            <td>{{ $c->user_gender }}</td>
                                            <td>



                                                <div class="table-data-feature">
                                                    <a href="{{ route('contact#details', $c->id) }} " class="me-2">


                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="details">
                                                            <i class="fa-solid fa-user-gear "></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('contact#delete', $c->id) }}">


                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete "></i>
                                                        </button>
                                                    </a>

                                                </div>



                    </div>
                    </td>


                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                @else
                    <h2 class="text-center text-danger mt-2">There is no data</h2>

                    @endif



                    </tbody>
                    </table>
                    <div>
                        {{ $contact->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->


@endsection
