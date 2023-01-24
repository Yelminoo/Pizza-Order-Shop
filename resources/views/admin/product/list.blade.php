@extends('admin.layouts.master')
@section('title', 'Product list')
@section('dashboard', 'Product dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add item
                                </button>
                            </a>
                            {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button> --}}
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

                    @if (session('updateSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ session('updateSuccess') }}</strong> .
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
                                    Search Key-{{ request('key') }}
                                </span>
                            </div>
                            <div class="offset-8">
                                <form action="{{ route('product#listPage') }}" method="get" class=" d-flex ">
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
                                    {{ $pizzas->total() }}
                                </div>

                            </div>
                    </div>


                    @if (count($pizzas) != 0)
                        <thead class="text-center
                        ">
                            <tr>
                                <th class="col-2">Image</th>
                                <th class="col-2">Name</th>

                                <th class="col-2">Price</th>
                                <th class="col-2">Category Id</th>
                                <th class="col-2">View count</th>

                            </tr>
                        </thead>
                        <tbody>



                            @foreach ($pizzas as $p)
                                <tr class="tr-shadow text-center">
                                    <td class=""><img src="{{ asset('storage/' . $p->image) }}"
                                            class="img-thumbnail shadow-sm" alt="">
                                    </td>
                                    <td class="col-2">{{ $p->name }}</td>
                                    <td class="col-2">{{ $p->price }}</td>
                                    <td class="col-2">{{ $p->category_name }}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye"></i>{{ $p->view_count }}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{ route('product#details', $p->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </a>

                                            <a href="{{ route('product#edit', $p->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>


                                            </a>

                                            <a href="{{ route('product#delete', $p->id) }}">

                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>

                                        </div>
                                    </td>


                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        @else
                            <div class="text-center my-2">
                                <h3>There is no data</h3>
                            </div>

                    @endif


                    </tbody>
                    </table>
                    <div>
                        {{ $pizzas->appends(request()->query())->links() }}

                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
