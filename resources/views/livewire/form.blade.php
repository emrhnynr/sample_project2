<div>
    <div align="center">
        <img alt="Logo" src="{{asset('media/logos/default.svg')}}" class="h-30px h-lg-37px"/>
    </div>
    <br><hr style="height:1.5px;border-width:0;background-color:gray">
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <br>
        <!--begin::Title-->
        <h1 class="text-gray-900 fw-bolder mb-3">
            Book a Meeting
        </h1>
        <!--end::Title-->

        <div class="text-gray-500 text-center fw-semibold fs-6">
            Fill the form, we'll back to you ASAP.
        </div>

        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">

        </div>
        <!--end::Subtitle--->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group--->
    <div class="fv-row mb-8">
        <!--begin::Name-->
        <input id="email" wire:model.live="email" placeholder="E-Mail Address" type="email" autocomplete="off" class="form-control bg-transparent"/>
        <!--end::Name-->
    </div>

    <div class="fv-row mb-8">
        <div class="row">
            <div class="col-md-6 col-12">
                <!--begin::Name-->
                <input id="name" wire:model.live="name" placeholder="Name" type="text" autocomplete="off" class="form-control bg-transparent"/>
                <!--end::Name-->
            </div>
            <div class="col-md-6 col-12">
                <!--begin::Name-->
                <input id="surname" wire:model.live="surname" placeholder="Surname" type="text" autocomplete="off" class="form-control bg-transparent"/>
                <!--end::Name-->
            </div>
        </div>
    </div>

    <div class="fv-row mb-8" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
            <div class="row">
                <div class="col-md-3">
                    <select id="phone_code" class="form-control" wire:model.live="phone_code">
                        @foreach($country_phone_codes as $code)
                            <option {{$code->code == $phone_code ? 'selected' : ''}} value="{{$code->code}}">{{$code->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-9">
                    <input wire:model.live="phone" id="phone" placeholder="Phone number" maxlength="11" class="form-control" type="text">
                </div>
            </div>
        </div>
        <!--end::Wrapper-->

    </div>
    <!--end::Input group--->

    <div wire:loading wire:target="submit" class="wire_loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <!--end::Input group--->

    @if($errors->first())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @elseif($success)
        <div class="alert alert-success">Form has been submitted succesfully.</div>
    @endif

    <div class="d-grid mb-10">
        <button id="submitBtn" wire:click="submit" type="submit" class="btn btn-primary">
            <span>Submit</span>
        </button>
    </div>

    <div class="text-gray-500 text-center fw-semibold fs-6">
        Are you admin?

        <a href="{{route('login')}}" class="link-primary fw-semibold">
            Sign In
        </a>
    </div>
</div>
