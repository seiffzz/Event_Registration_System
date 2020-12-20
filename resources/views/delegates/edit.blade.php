<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-3">
            <div class="grid grid-cols-3 w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="col-span-2">
                    <x-jet-validation-errors class="mb-4"/>
                    <form method="POST" action="{{route('delegates.update',$delegate->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}"/>
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                         :value="old('name')"
                                         required
                                         autofocus autocomplete="name" :value="$delegate->name"/>
                        </div>

                        <div class="mt-6">
                            <x-jet-label for="email" value="{{ __('Email') }}"/>
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')"
                                         required :value="$delegate->email"/>
                        </div>
                        <div class="lg:flex lg:flex-row justify-between items-center">
                            <div class="mt-6">
                                <x-jet-label for="dob" value="{{ __('Date of Birth') }}"/>
                                <x-jet-input id="dob" class="block mt-1 w-full" type="date" name="dob" required
                                             :value="old('dob')" :value="$delegate->dob" max="2004-12-30"/>
                            </div>
                            <div class="mt-6 lg:flex-grow lg:mx-8">
                                <x-jet-label for="gender" value="{{ __('Gender') }}"/>
                                <select id="gender" name="gender"
                                        class="mt-1 block w-full form-input" style="height:44px;">
                                    <option value="Male "
                                            @if(old('gender')=='Male'||$delegate->gender =='Male')selected @endif>{{__('Male')}}</option>
                                    <option value="Female "
                                            @if(old('gender')=='Female' || $delegate->gender == 'Female')selected @endif>{{__('Female')}}</option>
                                </select>
                            </div>
                            <div class="mt-6">
                                <x-jet-label for="phone_number" value="{{ __('Phone Number') }}"/>
                                <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                             required
                                             :value="old('phone_number')" :value="$delegate->phone_number"/>
                            </div>
                        </div>
                        <div class="lg:flex lg:flex-row justify-between">
                            <div class="mt-6 mr-5">
                                <x-jet-label for="id_front" value="{{ __('ID Front') }}"/>
                                <x-jet-input id="id_front" class="block mt-1 w-full overflow-ellipsis overflow-hidden"
                                             type="file" name="id_front"
                                             :value="old('id_front')" onchange="load_front_image(this)"/>
                            </div>
                            <div class="mt-6">
                                <x-jet-label for="id_back" value="{{ __('ID Back') }}"/>
                                <x-jet-input id="id_back" class="block mt-1 w-full overflow-ellipsis overflow-hidden"
                                             type="file" name="id_back"
                                             :value="old('id_back')" onchange="load_back_image(this)"/>
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
                        <div class="mt-6">
                            <x-jet-label for="function" value="{{ __('Role') }}"/>
                            <select name="role" id="role" class="mt-1 block w-full form-input" style="height: 44px"
                                    onclick="show()">
                                <option value="New Member"
                                        @if(old("role") == 'New Member' || $delegate->role == 'New Member')selected @endif>
                                    New Member
                                </option>
                                <option value="Old Member"
                                        @if(old("role") == 'Old Member' || $delegate->role == 'Old Member')selected @endif>
                                    Old Member
                                </option>
                                <option value="TL"
                                        @if(old("role") == 'TL' || $delegate->role == 'TL')selected @endif>TL
                                </option>
                                <option value="Coordinator"
                                        @if(old("role") == 'Coordinator' || $delegate->role == 'Coordinator')selected @endif>
                                    Coordinator
                                </option>
                                <option value="LCVP"
                                        @if(old("role") == 'LCVP' || $delegate->role == 'LCVP')selected @endif>
                                    LCVP
                                </option>
                                <option value="LCP"
                                        @if(old("role") == 'LCP' || $delegate->role == 'LCP')selected @endif>LCP
                                </option>

                            </select>
                        </div>
                        <div class="mt-6 hidden" id="function-dropdown">
                            <x-jet-label for="function" value="{{ __('Function') }}"/>
                            <select
                                class="mt-1 block w-full form-input" style="height:44px;" id="grid-gender"
                                name="function">
                                <option value="IGV"
                                        @if(old("function") == 'IGV' || $delegate->function == 'IGV')selected @endif>IGV
                                </option>
                                <option value="IGTe"
                                        @if(old("function") == 'IGTe' || $delegate->function == 'IGTe')selected @endif>
                                    IGTe
                                </option>
                                <option value="IGTa"
                                        @if(old("function") == 'IGTa' || $delegate->function == 'IGTa')selected @endif>
                                    IGTa
                                </option>
                                <option value="OGTa"
                                        @if(old("function") == 'OGTa' || $delegate->function == 'OGTa')selected @endif>
                                    OGTa
                                </option>
                                <option value="OGTe"
                                        @if(old("function") == 'OGTe' || $delegate->function == 'OGTe')selected @endif>
                                    OGTe
                                </option>
                                <option value="OGV"
                                        @if(old("function") == 'OGV' || $delegate->function == 'OGV')selected @endif>OGV
                                </option>
                                <option value="TM"
                                        @if(old("function") == 'TM' || $delegate->function == 'TM')selected @endif>TM
                                </option>
                                <option value="PD"
                                        @if(old("function") == 'PD' || $delegate->function == 'PD')selected @endif>PD
                                </option>
                                <option value="Finance"
                                        @if(old("function") == 'Finance' || $delegate->function == 'Finance')selected @endif>
                                    Finance
                                </option>
                                <option value="BCX ICX"
                                        @if(old("function") == 'BCX ICX' || $delegate->function == 'BCX ICX')selected @endif>
                                    BCX ICX
                                </option>
                                <option value="BCX OGX"
                                        @if(old("function") == 'BCX OGX' || $delegate->function == 'BCX OGX')selected @endif>
                                    BCX OGX
                                </option>
                                <option value="R&D"
                                        @if(old("function") == 'R&D' || $delegate->function == 'R&D')selected @endif>
                                    R&D
                                </option>
                            </select>

                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-jet-button class="ml-4">
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
                <div class="flex flex-col items-end">
                    <img id="id_front_img" src="{{asset('storage/ids/'.$delegate->id_front)}}" alt="" width="70%"
                         class="mb-7 rounded">
                    <img id="id_back_img" src="{{asset('storage/ids/'.$delegate->id_back)}}" alt="" width="70%"
                         class="rounded">
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script>
    function load_front_image(input) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#id_front_img')
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }

    function load_back_image(input) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#id_back_img')
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }

    function show() {
        var role = document.getElementById('role').value;
        if (role == 'Old Member' || role == 'TL' || role == 'Coordinator' || role == 'LCVP') {
            document.getElementById('function-dropdown').className = 'mt-6'
        } else {
            document.getElementById('function-dropdown').className = 'mt-6 hidden'
        }
    }

    window.onload = function () {
        var role = document.getElementById('role').value;
        if (role == 'Old Member' || role == 'TL' || role == 'Coordinator' || role == 'LCVP') {
            document.getElementById('function-dropdown').className = 'mt-6'
        } else {
            document.getElementById('function-dropdown').className = 'mt-6 hidden'
        }
    }

</script>
