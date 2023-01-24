@extends('admin.layouts.master')
@section('title', 'Account list')
@section('dashboard', 'Admin dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Account List</h2>

                            </div>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
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
                                <form action="{{ route('admin#listPage') }}" method="get" class=" d-flex ">
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
                                    {{ $admin->total() }}

                                </div>
                            </div>
                            @if (count($admin) != 0)

                                <thead>
                                    <tr class="text-center">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>

                                        <th>Role</th>


                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <td class=" col-2">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('image/female_default.png') }}" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $a->image) }}" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>{{ $a->role }}</td>
                                            <td>


                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <div class="table-data-feature">
                                                        <span class="me-2 ">
                                                            <input type="hidden" class="userId"
                                                                value="{{ $a->id }}">
                                                            <button class="item changeRole" data-toggle="tooltip"
                                                                data-placement="top" title="Change role">
                                                                <i class="fa-solid fa-user-gear "></i>
                                                            </button>


                                                        </span>
                                                        <a href="{{ route('admin#delete', $a->id) }}">


                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete "></i>
                                                            </button>
                                                        </a>

                                                    </div>
                                                @endif



                    </div>
                    </td>


                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                @else
                    <h2 class="text-center mt-2 text-danger">There is no data</h2>

                    @endif



                    </tbody>
                    </table>
                    <div>
                        {{ $admin->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.changeRole').click(function() {

                $userId = $('.userId').val();
                $.ajax({
                    type: 'get',
                    url: '/admin/ajax/change/role',
                    data: {
                        'user_id': $userId,
                    },
                    datatype: 'json',
                    success: function(response) {
                        window.location.href = '/admin/list';


                    }
                })

            })
        })
    </script>

@endsection
@endsection
