@extends('layouts.app')

@section('title') Create Sub-Category : {{$category->fieldData->name}} @endsection

@section('toolbar')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Create Sub Category: {{$category->fieldData->name}}</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{route('categories.index')}}" class="text-muted text-hover-primary">Categories</a>
            </li>
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{route('sub-categories.index', ['category_id' => $category->id])}}" class="text-muted text-hover-primary">Sub Categories: {{$category->fieldData->name}}</a>
            </li>
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Create Sub Category</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
        <!--end::Breadcrumb-->
    </div>
@endsection

@section('content')

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6" style="padding: 50px;">
            <!--begin::Card title-->

            <!--begin::Card title-->


            <div class="col-md-6 offset-md-3">

                <div style="margin-top: 35px;" class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 mb-3">
                        Create Sub-Category
                    </h1>
                    <!--end::Title-->
                    @livewire('sub-category.create-sub-category', ['category_id' => $category->id, 'subcategory_id' => null])
                </div>


            </div>
        </div>
    </div>

@endsection
