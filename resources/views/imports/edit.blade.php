<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-3">
            <div class="grid grid-cols-3 w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="col-span-3">
                    <x-jet-validation-errors class="mb-4"/>
                    <form method="POST" action="{{route('imports.update',$accepted_delegate->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}"/>
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"
                                         :value="old('name')"
                                         autofocus autocomplete="name" :value="$accepted_delegate->name"/>
                        </div>

                        <div class="mt-6">
                            <x-jet-label for="email" value="{{ __('Email') }}"/>
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')"
                                         :value="$accepted_delegate->email"/>
                        </div>
                        <div class="mt-6">
                            <x-jet-label for="phone_number" value="{{ __('Phone Number') }}"/>
                            <x-jet-input id="phone_number" class="block mt-1 w-full"
                                         type="text" name="phone_number"
                                         :value="old('phone_number')"
                                         :value="$accepted_delegate->phone_number"/>
                        </div>
                        <div class="mt-6">
                            <x-jet-label for="received_mail" value="{{ __('Received Mail') }}"/>
                            <x-jet-input id="received_mail" class="block mt-1 w-full"
                                         type="text" name="received_mail"
                                         :value="old('received_mail')"
                                         :value="$accepted_delegate->received_mail"/>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-jet-button class="ml-4">
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>

