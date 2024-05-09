@extends('layouts.app')

@section('title') Edit Sub-Category @endsection

@section('toolbar')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Edit Sub Category</h1>
        <!--end::Title-->
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
                        Edit Sub-Category
                    </h1>
                    <!--end::Title-->
                    @livewire('sub-category.create-sub-category', ['category_id' => null, 'subcategory_id' => $subcategory_id])
                </div>


            </div>
        </div>
    </div>

@endsection
