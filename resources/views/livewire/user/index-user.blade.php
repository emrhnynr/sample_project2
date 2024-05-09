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
                <!--begin::Filter-->
                <a href="{{route('users.create-invite')}}" class="btn btn-md btn-flex btn-light-primary">
                    <i class="ki-duotone ki-plus-square fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>Create Invite</a>
                <!--end::Add customer-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-125px">Status</th>
                <th class="min-w-125px">Name</th>
                <th class="min-w-125px">E-Mail</th>
                <th class="min-w-125px">Type</th>
                <th class="min-w-125px">Customer</th>
                <th class="text-end min-w-70px"></th>
            </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
            @foreach($invitees as $invite)
                @php $record = $invite->user ?: $invite @endphp
                <tr>
                    <td>
                        <a class="text-gray-800 text-hover-primary mb-1">@if($invite->user) <span style="color:green;">Active</span> @else <span style="color:orangered;">Invited</span> @endif</a>
                    </td>
                    <td>
                        <a class="text-gray-600 text-hover-primary mb-1">{{$record->name}}</a>
                    </td>
                    <td>
                        <a class="text-gray-600 text-hover-primary mb-1">{{$record->email}}</a>
                    </td>
                    <td>
                        <a class="text-gray-600 text-hover-primary mb-1">{{$record->type == 'admin' ? 'Admin' : 'Customer User' }}</a>
                    </td>
                    <td>
                        <a class="text-gray-600 text-hover-primary mb-1">{{$record->customer?->name}}</a>
                    </td>
                    <td class="text-end">
                        @if($record->id != \Illuminate\Support\Facades\Auth::user()->id)
                            <a title="Edit" href="{{$invite->user ? route('users.edit', ['user_id' => $record->id]) : route('users.edit-invite', ['invite_id' => $record->id])}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a title="delete" wire:click = "delete{{$invite->user ? 'User' : 'Invite'}}({{$record->id}})" href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </a>
                        @endif
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{$invite->user ? route('users.edit', ['user_id' => $record->id]) : route('users.edit-invite', ['invite_id' => $record->id])}}" class="menu-link px-3">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a wire:click = "delete{{$invite->user ? 'User' : 'Invite'}}({{$record->id}})" href="javascript:void(0)" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
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
    </div>
    <div wire:loading class="wire_loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <!--end::Card body-->
</div>
