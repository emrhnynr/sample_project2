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
            <h1 class="text-gray-900 fw-bolder mb-3">
                Sign Up
            </h1>
            <!--end::Title-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">

            </div>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Name-->
            <input wire:model.live="email" placeholder="E-Mail Address" type="email" autocomplete="off" class="form-control bg-transparent"/>
            <!--end::Name-->
        </div>

        <div class="fv-row mb-8">
            <div class="row">
                <div class="col-md-6 col-12">
                    <!--begin::Name-->
                    <input wire:model.live="name" placeholder="Name" type="text" autocomplete="off" class="form-control bg-transparent"/>
                    <!--end::Name-->
                </div>
                <div class="col-md-6 col-12">
                    <!--begin::Name-->
                    <input wire:model.live="surname" placeholder="Surname" type="text" autocomplete="off" class="form-control bg-transparent"/>
                    <!--end::Name-->
                </div>
            </div>
        </div>

        <div class="fv-row mb-8" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input wire:model.live="password" class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off"/>

                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->


            </div>
            <!--end::Wrapper-->

        </div>
        <!--end::Input group--->

        <!--end::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Repeat Password-->
            <input wire:model.live="repeatPassword" placeholder="Repeat Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent"/>

            <!--end::Repeat Password-->
        </div>
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
                <span>Sign Up</span>
            </button>
        </div>

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Already have an Account?

            <a href="{{route('login')}}" class="link-primary fw-semibold">
                Sign In
            </a>
        </div>
</div>
