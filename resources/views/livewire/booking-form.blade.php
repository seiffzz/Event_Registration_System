<div class="w-full">
    <x-jet-authentication-card id="auth-card">
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>
        <form method="POST" action="{{route('event.register',isset($event)?$event:$data['event'])}}"
              enctype="multipart/form-data" id="form-3">
            @csrf
            <div class="text-md my-3 text-blue-600 font-bold">*Please be advised that the conference fees are 825 EGP.
            </div>
            <div class="lg:flex lg:flex-row">
                <div class="text-sm lg:mb-5 lg:mx-1 mb-3"> For more info about the conference and the venue please check
                    our
                    website:
                </div>
                <div class="text-sm mb-5 hover:text-blue-500 cursor-pointer underline font-bold"
                     onclick="window.location.href='http://aspire20-cu.aieseccu.com'">ASPIRE'20
                </div>
            </div>

            <div>
                <x-jet-label class="font-semibold" for="name" value="{{ __('Full Name') }}"/>
                @if($data != null)
                    <x-jet-input id="name" class="block mt-1 w-full disabled" type="text" name="name"
                                 :value="old('name')"
                                 required
                                 autocomplete="name"
                                 :value="isset($data['delegate']->name)?$data['delegate']->name:''"
                                 readonly="true"/>
                @else
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                 required
                                 autofocus autocomplete="name"/>
                @endif
            </div>

            <div class="mt-6">
                <x-jet-label class="font-semibold" for="email" value="{{ __('Email') }}"/>
                @if($data != null)
                    <x-jet-input id="email" class="block mt-1 w-full disabled" type="email" name="email"
                                 :value="old('email')"
                                 required :value="isset($data['delegate']->email)?$data['delegate']->email:''"
                                 readonly="true"/>
                @else
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                 required/>
                @endif
            </div>
            <div class="lg:flex lg:flex-row justify-between items-center">
                <div class="mt-6">
                    <x-jet-label class="font-semibold" for="dob" value="{{ __('Date of Birth') }}"/>
                    <x-jet-input id="dob" class="block mt-1 w-full" type="date" name="dob" required
                                 :value="old('dob')" max="2004-12-30"/>
                </div>
                <div class="mt-6 lg:flex-grow lg:mx-8">
                    <x-jet-label class="font-semibold" for="gender" value="{{ __('Gender') }}"/>
                    <select id="gender" name="gender"
                            class="mt-1 block w-full form-input" style="height:44px;">
                        <option value="Male " @if(old('gender')=='Male')selected @endif>{{__('Male')}}</option>
                        <option value="Female "
                                @if(old('gender')=='Female')selected @endif>{{__('Female')}}</option>
                    </select>
                </div>
                <div class="mt-6">
                    <x-jet-label class="font-semibold" for="phone_number" value="{{ __('Phone Number') }}"/>
                    @if($data != null)
                        <x-jet-input id="phone_number" class="block mt-1 w-full disabled" type="text"
                                     name="phone_number"
                                     :value="old('phone_number')"
                                     required
                                     :value="isset($data['delegate']->phone_number)?$data['delegate']->phone_number:''"
                                     readonly="true"/>
                    @else
                        <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                     :value="old('phone_number')"
                                     required/>
                    @endif
                </div>
            </div>
            <div class="lg:flex lg:flex-row justify-between">
                <div class="mt-6 lg:mr-5">
                    <div class="flex flex-row items-center">
                        <x-jet-label class="mr-1 font-semibold" for="id_front" value="{{ __('ID Front') }}"/>
                        <p class="text-xs font-light text-red-500">*max size 1 MB</p>
                    </div>

                    <x-jet-input id="id_front" class="block mt-1 w-full overflow-ellipsis overflow-hidden" type="file"
                                 name="id_front" required
                                 :value="old('id_front')"/>
                </div>
                <div class="mt-6">
                    <div class="flex flex-row items-center">
                        <x-jet-label class="mr-1 font-semibold" for="id_back" value="{{ __('ID Back') }}"/>
                        <p class="text-xs font-light text-red-500">*max size 1 MB</p>
                    </div>
                    <x-jet-input id="id_back" class="block mt-1 w-full overflow-ellipsis overflow-hidden" type="file"
                                 name="id_back" required
                                 :value="old('id_back')"/>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex flex-row items-center">
                    <x-jet-label class="font-semibold" for="allergies" value="{{ __('Do You Have any Allergies?') }}"/>
                    <p class="text-xs ml-2">if no leave it empty.</p>
                </div>
                <x-jet-input id="allergies" class="block mt-1 w-full" type="text" name="allergies"
                             :value="old('allergies')"/>
            </div>
            <div class="mt-6 hidden">
                <x-jet-label class="font-semibold" for="lc" value="{{ __('Local Committee') }}"/>
                <select name="lc" id="" class="hidden">
                    <option value="Cairo University" selected>Cairo University</option>
                </select>
                @livewire('lc-dropdown')
            </div>
            @if($data!=null)
                <div class="mt-6">
                    <x-jet-label class="font-semibold" for="role" value="{{ __('Role') }}"/>
                    <x-jet-input id="role" class="block mt-1 w-full disabled" type="text" name="role"
                                 :value="old('role')"
                                 required :value="isset($data['delegate']->role)?$data['delegate']->role:''"
                                 readonly="true"/>
                </div>
            @else
                <div class="mt-6">
                    <x-jet-label class="font-semibold" for="role" value="{{ __('Role') }}"/>
                    <select name="role" id="role" class="mt-1 block w-full form-input" style="height: 44px"
                            onchange="show()">
                        <option value="New Member" {{ (old("role") === 'New Member' ? "selected":"") }}>New Member
                        </option>
                        <option value="Old Member" {{ (old("role") === 'Old Member' ? "selected":"") }}>Old Member
                        </option>
                        <option value="TL" {{ (old("role") === 'TL' ? "selected":"") }}>TL</option>
                        <option value="Coordinator" {{ (old("role") === 'Coordinator' ? "selected":"") }}>Coordinator
                        </option>
                        <option value="LCVP" {{ (old("role") === 'LCVP' ? "selected":"") }}>LCVP</option>
                        <option value="LCP" {{ (old("role") === 'LCP' ? "selected":"") }}>LCP</option>
                        {{--                    <option value="MCVP" {{ (old("role") === 'MCVP' ? "selected":"") }}>MCVP</option>--}}
                        {{--                    <option value="MCP" {{ (old("role") === 'MCP' ? "selected":"") }}>MCP</option>--}}
                    </select>
                </div>
            @endif
            @if($data==null)
                <div class="mt-6 hidden" id="function-dropdown">
                    <x-jet-label class="font-semibold" for="function" value="{{ __('Function') }}"/>
                    <select
                        class="mt-1 block w-full form-input" style="height:44px;" id="grid-gender" name="function">
                        <option value="IGV" {{ (old("function") === 'IGV' ? "selected":"") }}>IGV</option>
                        <option value="IGTe" {{ (old("function") === 'IGTe' ? "selected":"") }}>IGTe</option>
                        <option value="IGTa" {{ (old("function") === 'IGTa' ? "selected":"") }}>IGTa</option>
                        <option value="OGTa" {{ (old("function") === 'OGTa' ? "selected":"") }}>OGTa</option>
                        <option value="OGTe" {{ (old("function") === 'OGTe' ? "selected":"") }}>OGTe</option>
                        <option value="OGV" {{ (old("function") === 'OGV' ? "selected":"") }}>OGV</option>
                        <option value="TM" {{ (old("function") === 'TM' ? "selected":"") }}>TM</option>
                        <option value="PD" {{ (old("function") === 'PD' ? "selected":"") }}>PD</option>
                        <option value="Finance" {{ (old("function") === 'Finance' ? "selected":"") }}>Finance</option>
                        <option value="BCX ICX" {{ (old("function") === 'BCX ICX' ? "selected":"") }}>BCX ICX</option>
                        <option value="BCX OGX" {{ (old("function") === 'BCX OGX' ? "selected":"") }}>BCX OGX</option>
                        <option value="R&D" {{ (old("function") === 'R&D' ? "selected":"") }}>R&D</option>
                    </select>

                </div>
            @endif
            <div class="flex items-center justify-end mt-6">
                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</div>
<script>
    $('#form-3').submit(function (e) {
        $(':disabled').each(function (e) {
            $(this).removeAttr('disabled')
        })
    })

    function show() {
        var role = document.getElementById('role').value;
        if (role != 'Newbei') {
            if (role == 'Old Member' || role == 'TL' || role == 'Coordinator' || role == 'LCVP') {
                document.getElementById('function-dropdown').className = 'mt-6'
            } else {
                document.getElementById('function-dropdown').className = 'mt-6 hidden'
            }
        }
    }

    window.onload = function () {
        var role = document.getElementById('role').value;
        if (role != 'Newbie') {

            if (role == 'Old Member' || role == 'TL' || role == 'Coordinator' || role == 'LCVP') {
                document.getElementById('function-dropdown').className = 'mt-6'
            } else {
                document.getElementById('function-dropdown').className = 'mt-6 hidden'
            }
        }
    }

</script>
