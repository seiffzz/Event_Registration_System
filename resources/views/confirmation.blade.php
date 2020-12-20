<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>
        @if ($message == 'success')
            <div class="text-success text-center font-weight-bold">
                <p class="text-center text-green-500">We have received your registration and we cannot wait to see you
                    in
                    ASPIRE'20!</p>
                <br>
{{--                <p class="text-center text-blue-500">Kindly Be Advised That The Conference Fees Are 825 EGP.</p>--}}
{{--                <br>--}}
                <p class="text-center">For more info about ASPIRE'20 or the venue check our website:
                <p class="hover:text-blue-500 underline cursor-pointer font-bold"
                   onclick="window.location.href='http://aspire20-cu.aieseccu.com'">ASPIRE'20</p></p>
            </div>


        @endif
    </x-jet-authentication-card>
</x-guest-layout>
