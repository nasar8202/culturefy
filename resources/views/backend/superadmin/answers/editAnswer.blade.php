@extends('backend.superadmin.layouts.app')
@section('title','Edit Answer Form')
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
                <h3>Edit Answer Form </h3>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('superadmin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Answer Form </li>
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
                        <h4 class="card-title">Edit Answer</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('updateAnswer',$BrandCultureAnswer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-4 col-12">
                                        <div class="col-md-12 mb-4 col-12">
                                            <h6>Select Question</h6>

                                            <fieldset class="form-group">
                                                <select class="form-select" name="brand_culture_question_id" id="basicSelect">
                                                    <option value="" disabled aria-readonly="">Select Question</option>
                                                    @if ((count($BrandCultureQuestion)) == 0)
                                                    <option value="" aria-readonly="" disabled>No Category Found!</option>
                                                    @else
                                                    
                                                  
                                                    @foreach($BrandCultureQuestion as $child)
                                                  
                                                     <option value="{{ $child->id }}"@if($BrandCultureAnswer->brand_culture_question_id == $child->id) selected @endif >{{ $child->question ?? 'No Question'  }}</option>
                                                  
                                                    
                                      
                                                    @endforeach
                                                    @endif
    
    
                                                </select>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-12 mb-4 col-12">
                                            <div class="form-group with-title mb-3">
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    rows="3" name="answer">{{ $BrandCultureAnswer->answer }}</textarea>
                                                <label>Type Your Answer</label>
                                            </div>
                                        </div>

                                        @if ($errors->has('answer'))
                                        <span class="text-danger">{{ $errors->first('answer') }}</span>
                                        @endif
                                        </div>
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
