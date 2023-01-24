@extends('admin.layouts.master')
@section('title', 'User list')
@section('dashboard', 'User dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Users List</h2>

                            </div>
                        </div>

                        <div class="table-data__tool-right">

                        </div>
                    </div>

                    @if (session('editSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('editSuccess') }}</strong> .
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

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
                        <table class="table table-data5 text-muted">
                            <div class="d-inline my-2">
                                <span>
                                    Search Key- {{ request('key') }}
                                </span>
                            </div>
                            <div class="offset-8">
                                <form action="{{ route('user#listPage') }}" method="get" class=" d-flex ">
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
                                    {{ $user->total() }}

                                </div>
                            </div>
                            @if (count($user) != 0)

                                <thead>
                                    <tr class="text-center">
                                        <th class="col-1">Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Gender</th>




                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                    @foreach ($user as $u)
                                        <tr class="tr-shadow">
                                            <td class=" col-1">
                                                @if ($u->image == null)
                                                    @if ($u->gender == 'male')
                                                        <img src="{{ asset('image/istockphoto-1300845620-612x612.jpg') }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('image/female_default.png') }}" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $u->image) }}" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->phone }}</td>
                                            <td>{{ $u->address }}</td>
                                            <td>{{ $u->gender }}</td>

                                            <td>



                                                <div class="table-data-feature">
                                                    <span class="me-2 ">
                                                        <input type="hidden" class="userId" value="{{ $u->id }}">
                                                        <button class="item changeRole" data-toggle="tooltip"
                                                            data-placement="top" title="Change role">
                                                            <i class="fa-solid fa-user-gear "></i>
                                                        </button>


                                                    </span>

                                                    <a href="{{ route('user#editPageByAdmin', $u->id) }}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>


                                                    </a>
                                                    <a href="{{ route('user#delete', $u->id) }}">


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
                    <h2 class="text-center mt-2 text-danger">There is no data</h2>

                    @endif



                    </tbody>
                    </table>
                    <div>
                        {{ $user->appends(request()->query())->links() }}
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
                    url: '/user/ajax/change/userRole',
                    data: {
                        'user_id': $userId,
                    },
                    datatype: 'json',
                    success: function(response) {
                        window.location.href = '/user/userlist';


                    }
                })

            })
        })
    </script>

@endsection
@endsection
