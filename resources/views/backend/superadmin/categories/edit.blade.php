@extends('backend.superadmin.layouts.app')
@section('title','Edit Category Form')
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
                <h3>Edit Category Form </h3>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Category Form </li>
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
                        <h4 class="card-title">Edit Category</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('updateCategory',$brandCategory->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-4 col-12">
                                        <div class="col-md-12 mb-4 col-12">
                                            <h6>Select Parent Category</h6>
                                            <fieldset class="form-group">
                                                <select  class="form-select" d name="parent_id" id="basicSelect">
                                                    <option value="" disabled aria-readonly="">Select Category</option>
                                                    @if ($brandCategory->parent_id == 0)
                                                    <option selected value="" aria-readonly="" disabled>No Parent Category Found</option>
                                                    @foreach ($brandCategories as $category )
                                                   
                                                    <option  value="{{ $category->id }}"  >{{  $category->category_name ?? '';  }}</option>
                                                    @endforeach
                                                    @else
                                                    {{-- <optgroup label="Your Selected Category"> --}}
                                                    {{-- <option  selected  value="{{ $brandCategory->parent_id }}"  >{{  $brandCategory->sub_category['category_name'] ?? '';  }}</option> --}}
                                                    {{-- <optgroup label="All Categories"> --}}
                                                    @foreach ($brandCategories as $category )
                                                   
                                                    <option  value="{{ $category->id }}" @if($brandCategory->parent_id == $category->id) selected @endif  >{{  $category->category_name ?? '';  }}</option>
                                                    @endforeach
                                                    @endif

                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="form-group">
                                            <label for="squareText">Edit Category</label>
                                            <input type="text" id="category" name="category_name" value="{{ $brandCategory->category_name }}" class="form-control square"
                                                placeholder="add Category">
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
