<form onsubmit="return false;" class="form" style="width: 100%;" novalidate="novalidate" id="kt_password_reset_form">
    <br><br>

        <!--begin::Input group--->


    <div class="fv-row mb-8">
    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
        <input wire:model.live="header_mega_menu_display" class="form-check-input" type="checkbox" value="1" />
        <span style="color: #707070;" class="form-check-label">Header Mega Menu Display</span>
    </label>
    </div>
    @if($subcategory_id)
        <div class="fv-row mb-8">
            <input disabled type="text" value="Main Category: {{$main_category_name}}" autocomplete="off" class="form-control bg-transparent" />
        </div>
    @endif
    <div class="fv-row mb-8">

        <input wire:model.live="name" type="text" placeholder="Sub-Category Name" autocomplete="off" class="form-control bg-transparent" />

    </div>
    <div class="fv-row mb-8">

        <input wire:model.live="slug" type="text" placeholder="Slug" name="slug" autocomplete="off" class="form-control bg-transparent" />

    </div>

    @if($errors->first())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @elseif(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
     <!--begin::Actions-->
     <div class="d-grid mb-10">
         <button wire:click="submit" type="submit" class="btn btn-primary">
             <span>Submit</span>
         </button>
     </div>
     <!--end::Actions-->
    <div wire:loading wire:target="submit" class="wire_loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    </form>
