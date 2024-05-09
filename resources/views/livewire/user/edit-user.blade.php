
            <form onsubmit="return false;" class="form" style="width: 100%;" novalidate="novalidate" id="kt_password_reset_form">

        <!--begin::Input group--->

        <div class="fv-row mb-8">
            <!--begin::Type-->
            <select wire:model.live="type" class="form-control bg-transparent">
                <option readonly="" value="">Select User Type</option>
                <option {{$type == 'admin' ? 'selected' : ''}} value="admin">Admin</option>
                <option {{$type == 'customer' ? 'selected' : ''}} value="customer">Customer User</option>
            </select>
            <!--end::Type-->
        </div>
        @if($type == 'customer')
            <div class="fv-row mb-8">
                <!--begin::Type-->
                <select wire:model.live="customer_id" class="form-control bg-transparent">
                    <option readonly="" value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option {{$customer_id == $customer->id ? 'selected' : ''}} value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
                <!--end::Type-->
            </div>
        @endif
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input wire:model.live="name" type="text" placeholder="Name & Surname" autocomplete="off" class="form-control bg-transparent" />
            <!--end::Email-->
        </div>
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input disabled wire:model.live="email" type="email" placeholder="E-Mail" name="email" autocomplete="off" class="form-control bg-transparent" />
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
