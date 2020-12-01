<div class="w-full">
    <x-jet-authentication-card id="auth-card">
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{route('event.register',$event)}}" enctype="multipart/form-data">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}"/>
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name"/>
            </div>

            <div class="mt-6">
                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                             required/>
            </div>
            <div class="lg:flex lg:flex-row justify-between items-center">
                <div class="mt-6">
                    <x-jet-label for="dob" value="{{ __('Date of Birth') }}"/>
                    <x-jet-input id="dob" class="block mt-1 w-full" type="date" name="dob" required
                                 :value="old('dob')" max="2004-12-30"/>
                </div>
                <div class="mt-6 lg:flex-grow lg:mx-8">
                    <x-jet-label for="gender" value="{{ __('Gender') }}"/>
                    <select id="gender" name="gender"
                            class="mt-1 block w-full form-input" style="height:44px;">
                        <option value="Male " @if(old('gender')=='Male')selected @endif>{{__('Male')}}</option>
                        <option value="Female "
                                @if(old('gender')=='Female')selected @endif>{{__('Female')}}</option>
                    </select>
                </div>
                <div class="mt-6">
                    <x-jet-label for="phone_number" value="{{ __('Phone Number') }}"/>
                    <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" required
                                 :value="old('phone_number')"/>
                </div>
            </div>
            <div class="lg:flex lg:flex-row justify-between">
                <div class="mt-6 mr-5">
                    <x-jet-label for="id_front" value="{{ __('ID Front') }}"/>
                    <x-jet-input id="id_front" class="block mt-1 w-full overflow-ellipsis overflow-hidden" type="file"
                                 name="id_front" required
                                 :value="old('id_front')"/>
                </div>
                <div class="mt-6">
                    <x-jet-label for="id_back" value="{{ __('ID Back') }}"/>
                    <x-jet-input id="id_back" class="block mt-1 w-full overflow-ellipsis overflow-hidden" type="file"
                                 name="id_back" required
                                 :value="old('id_back')"/>
                </div>
            </div>
            <div class="mt-6">
                <div class="flex flex-row items-end">
                    <x-jet-label for="allergies" value="{{ __('Do You Have any Allergies?') }}"/>
                    <p class="text-xs ml-2">if no leave it empty.</p>
                </div>
                <x-jet-input id="allergies" class="block mt-1 w-full" type="text" name="allergies"
                             :value="old('allergies')"/>
            </div>
            <div class="mt-6 hidden">
                <x-jet-label for="lc" value="{{ __('Local Committee') }}"/>
                <select name="lc" id="" class="hidden">
                    <option value="Cairo University" selected>Cairo University</option>
                </select>
                @livewire('lc-dropdown')
            </div>
            <div class="mt-6">
                <x-jet-label for="function" value="{{ __('Role') }}"/>
                <select name="role" id="role" class="mt-1 block w-full form-input" style="height: 44px"
                        onchange="show()">
                    <option value="New Member" {{ (old("role") === 'New Member' ? "selected":"") }}>New Member</option>
                    <option value="Old Member" {{ (old("role") === 'Old Member' ? "selected":"") }}>Old Member</option>
                    <option value="TL" {{ (old("role") === 'TL' ? "selected":"") }}>TL</option>
                    <option value="Coordinator" {{ (old("role") === 'Coordinator' ? "selected":"") }}>Coordinator
                    </option>
                    <option value="LCVP" {{ (old("role") === 'LCVP' ? "selected":"") }}>LCVP</option>
                    <option value="LCP" {{ (old("role") === 'LCP' ? "selected":"") }}>LCP</option>
{{--                    <option value="MCVP" {{ (old("role") === 'MCVP' ? "selected":"") }}>MCVP</option>--}}
                    {{--                    <option value="MCP" {{ (old("role") === 'MCP' ? "selected":"") }}>MCP</option>--}}
                </select>
            </div>
            <div class="mt-6 hidden" id="function-dropdown">
                <x-jet-label for="function" value="{{ __('Function') }}"/>
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
                </select>

            </div>
            <div class="flex items-center justify-end mt-6">
                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</div>

