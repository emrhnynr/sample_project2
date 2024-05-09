<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end">
                <!--begin::Filter-->
                <a href="{{route('categories.create')}}" class="btn btn-md btn-flex btn-light-primary">
                    <i class="ki-duotone ki-plus-square fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>Create Category</a>
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
                <th style="color: black;" class="min-w-125px">Name</th>
                <th style="color: black;" class="min-w-125px">Slug</th>
                <th class="text-end min-w-70px"></th>
                <th class="text-end min-w-70px"></th>
            </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
            @foreach($categories->items as $category)
                <tr>
                    <td>
                        <a class="text-gray-600 text-hover-primary mb-1">{{$category->fieldData->name}}</a>
                    </td>
                    <td>
                        <a class="text-gray-600 text-hover-primary mb-1">{{$category->fieldData->slug}}</a>
                    </td>

                    <td class="text-end">
                        <a href="{{route('sub-categories.index', ['category_id' => $category->id])}}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-150px h-35px">Sub Categories</a>
                    </td>

                    <td class="text-end">
                        <a title="Edit" href="{{route('categories.edit', ['category_id' => $category->id])}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <a title="delete" wire:click = "delete({{json_encode($category->id)}})" href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </a><!--end::Menu-->
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
