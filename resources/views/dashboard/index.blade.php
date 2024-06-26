@extends('layouts.app')

@section('title') Dashboard @endsection

@section('toolbar')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Forms</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{route('dashboard.home')}}" class="text-muted text-hover-primary">Home</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">Forms</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection

@section('content')

    @livewire('dashboard.form-list')

@endsection

@section('links')
    <link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('js/custom/apps/customers/list/export.js')}}"></script>
    <script src="{{asset('js/custom/apps/customers/list/list.js')}}"></script>
    <script src="{{asset('js/custom/apps/customers/add.js')}}"></script>
    <script src="{{asset('js/widgets.bundle.js')}}"></script>
    <script src="{{asset('js/custom/widgets.js')}}"></script>
    <script src="{{asset('js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('js/custom/utilities/modals/users-search.js')}}"></script>
@endsection
