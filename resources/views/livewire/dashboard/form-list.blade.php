<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input wire:model.live="search" type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Search" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end">

            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        @if($formsCount == 0)
            <p align="center">Results not found.</p>
        @else
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-125px">Date</th>
                <th class="min-w-125px">Name & Surname</th>
                <th class="min-w-125px">E-Mail</th>
                <th class="min-w-125px">Phone</th>
                <th class="text-end min-w-70px"></th>
            </tr>
            </thead>
                <tbody class="fw-semibold text-gray-600">
                @foreach($forms as $form)
                    <tr>
                        <td>
                            <a class="text-gray-800 text-hover-primary mb-1">{{$form->created_at->format('d-m-Y')}}</a>
                        </td>
                        <td>
                            <a class="text-gray-600 text-hover-primary mb-1">{{$form->name." ".$form->surname}}</a>
                        </td>
                        <td>
                            <a href="mailto:{{$form->email}}" class="text-gray-600 text-hover-primary mb-1">{{$form->email}}</a>
                        </td>
                        <td>
                            <a href="tel:{{$form->email}}" class="text-gray-600 text-hover-primary mb-1">{{$form->phone}}</a>
                        </td>
                        <td class="text-end">
                            <a title="delete" wire:click = "delete({{$form->id}})" href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </a>
                            <!--begin::Menu-->

                            <!--end::Menu-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
        <!--end::Table-->

        <br>

        <nav>
            <ul class="pagination">
                <li class="page-item {{$page === 1 ? 'disabled' : ''}}">
                    <a wire:click="changePage({{$page - 1}})" class="page-link" href="javascript:void(0)" tabindex="-1">&laquo;</a>
                </li>
                @php $count = 0; @endphp
                @while($count < $total_pages)
                    @php $count++; @endphp
                    <li wire:click="changePage({{$count}})" class="page-item {{$page === $count ? 'active' : ''}}"><a class="page-link" href="javascript:void(0)">{{$count}}</a></li>
                @endwhile


                <li class="page-item {{$page == $total_pages ? 'disabled' : ''}}">
                    <a wire:click="changePage({{$page + 1}})" class="page-link" href="javascript:void(0)">&raquo;</a>
                </li>
            </ul>
        </nav>
        @endif
        <br>
        <span>5 results per page</span>
    </div>
    <div wire:loading class="wire_loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <!--end::Card body-->
</div>

