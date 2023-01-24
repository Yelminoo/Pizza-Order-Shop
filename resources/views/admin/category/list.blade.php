@extends('admin.layouts.master')
@section('title', 'categorylist')
@section('dashboard', 'Category dashboard')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
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
                                    Search Key- {{ request('key') }}
                                </span>
                            </div>
                            <div class="offset-8">
                                <form action="{{ route('list#Page') }}" method="get" class=" d-flex ">
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
                                    {{ $categories->total() }}
                                </div>
                            </div>
                            @if (count($categories) != 0)

                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category name</th>

                                        <th>Createdate</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>
                                                {{ $category->id }}
                                            </td>
                                            <td class="desc">{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>CRUD</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                    <a href="{{ route('category#editPage', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>


                                                    </a>

                                                    <a href="{{ route('category#delete', $category->id) }}">

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
                                    <h2 class="text-center mt-2 text-danger">There is no data</h2>

                            @endif



                            </tbody>
                        </table>
                        <div>
                            {{ $categories->appends(request()->query())->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
