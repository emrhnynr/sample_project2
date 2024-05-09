<form onsubmit="return false;" class="form" style="width: 100%;" novalidate="novalidate" id="kt_password_reset_form">

        <!--begin::Input group--->

        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input wire:model.live="name" type="text" placeholder="Customer Name" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Email-->
        </div>
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input wire:model.live="collectionId" type="number" placeholder="Collection ID" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Email-->
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

