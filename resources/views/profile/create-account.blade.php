<x-jet-action-section>
    <x-slot name="title">
        {{ __('Create Accounts') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create new accounts.') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-3 max-w-xl text-gray-600">
            <p>
                {{ __('You can create admin and viewer accounts.') }}
            </p>
        </div>
        <div class="flex flex-row items-center">

            <div class="mt-5 mr-5">
                <x-jet-button onclick="window.location.href='{{route('create_account','admin')}}'"
                              wire:loading.attr="disabled">
                    {{ __('Create Admin') }}
                </x-jet-button>
            </div>
            {{--        <div class="mt-3 max-w-xl text-lg text-gray-600">--}}
            {{--            <p>--}}
            {{--                {{ __('Create an viewer account.') }}--}}
            {{--            </p>--}}
            {{--        </div>--}}
            <div class="mt-5">
                <x-jet-button onclick="window.location.href='{{route('create_account','moderator')}}'"
                              wire:loading.attr="disabled">
                    {{ __('Create Viewer') }}
                </x-jet-button>
            </div>
        </div>
    </x-slot>
</x-jet-action-section>
