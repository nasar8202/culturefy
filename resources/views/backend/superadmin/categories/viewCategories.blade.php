@extends('backend.superadmin.layouts.app')
@section('title','View All Categories')
@section('secton')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>View Categories </h3>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Categories  </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div
                    class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>View Categories
                    </h4>
                    <ul class="list-inline d-flex mb-0">
                        <li class="d-flex align-items-center">
                            <i class="bx bx-check-circle font-medium-3 me-50"></i>
                            <div class="buttons">
                                <a href="{{ route('subCategoryForm') }}" class="btn btn-primary">Add New Category</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>S.#</th>
                            <th>Category</th>
                            <th>Parent Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @forelse ($brandCategories as $brandCategory )
                        <tr>
                            <td>{{ $i++ }}</td>

                            <td>{{ $brandCategory['category_name'] }}</td>
                            <td>
                                @php
                                    echo $brandCategory->sub_category['category_name']??'No Parent Category'
                                @endphp
                            </td>
                            <td>
                                <a href="{{ route('EditCategoryForm',$brandCategory['id'] )}} "><span class="badge bg-primary">Edit</span></a>
                                <a href="{{ route('deleteCateegory',$brandCategory['id'] )}} "><span class="badge bg-danger">Delete</span></a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" align="center">
                                <span >No Record found!</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection
