@extends('backend.superadmin.layouts.app')
@section('title','Create Role')
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
                <h3>Category Form </h3>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category Form </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Category</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('storeSubCategory') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-4 col-12">
                                        <h6>Select Main Category<small class="text-secondary"> (Optional : If You Are Making Parent Category)</small> </h6>

                                        <fieldset class="form-group">
                                            <select class="form-select" name="id" id="basicSelect">
                                                <option value="0" aria-readonly="">Select Parent Category </option>
                                                @if ((count($brandCategories)) == 0)
                                                <option value="" aria-readonly="" disabled>No Category Found!</option>
                                                @else
                                                @foreach ($brandCategories as $category )
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                                @endif


                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mb-4 col-12">
                                        <div class="form-group">
                                            <label for="squareText">Add Category</label>
                                            <input type="text" id="category" name="category_name" class="form-control square"
                                                placeholder="Add Category">
                                        </div>
                                        @if ($errors->has('category_name'))
                                        <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>
@endsection
