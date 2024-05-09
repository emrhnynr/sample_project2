<div>
        <div align="center">
            <a href="{{route('index')}}">
                <img alt="Logo" src="{{asset('media/logos/default.svg')}}" class="h-30px h-lg-37px"/>
            </a>
        </div>
        <br><hr style="height:1.5px;border-width:0;background-color:gray">
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
            <!--end::Title-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input wire:model.live="email" type="email" maxlength="255" placeholder="Email Address" autocomplete="off" class="form-control bg-transparent"/>
            <!--end::Email-->
        </div>

        <!--end::Input group--->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input wire:model.live="password" type="password" maxlength="255" placeholder="Password" autocomplete="off" class="form-control bg-transparent"/>
            <!--end::Password-->
        </div>
        <!--end::Input group--->
        <!--begin::Submit button-->
    <div wire:loading wire:target="submit" class="wire_loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <!--end::Input group--->

    @if($errors->first())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif

    <div class="d-grid mb-10">
        <button wire:click="submit" type="submit" class="btn btn-primary">
            <span>Sign In</span>
        </button>
    </div>
        <!--end::Submit button-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Don't you have an account?

            <a href="{{route('register')}}" class="link-primary fw-semibold">
                Sign Up
            </a>
</div>
