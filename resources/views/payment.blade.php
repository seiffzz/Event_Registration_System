<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activate</title>
</head>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="{{asset('js/scripts.js')}}"></script>
<body>
<div class="w-full">
    <x-jet-authentication-card id="auth-card">
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{route('event.payment',$delegate->id)}}" enctype="multipart/form-data">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}"/>
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                             autofocus autocomplete="name" :value="$delegate->name" disabled="true"/>
            </div>
            <div class="mt-6">
                <x-jet-label for="function" value="{{ __('Payment Method') }}"/>
                <select name="payment_method" id="payment_method" class="mt-1 block w-full form-input"
                        style="height: 44px">
                    <option
                        value="Vodafone Cash" {{ (old("payment_method") === 'Vodafone Cash' ? "selected":"") }}>{{__('Vodafone Cash')}}</option>
                    <option
                        value="Bank Account" {{ (old("payment_method") === 'Bank Account' ? "selected":"") }}>{{__('Bank Account')}}</option>
                </select>
            </div>
            <div class="mt-6">
                <x-jet-label for="transaction_number" value="{{ __('Transaction Number') }}"/>
                <x-jet-input id="transaction_number" class="block mt-1 w-full" type="text" name="transaction_number"
                             :value="old('transaction_number')"
                             required/>
            </div>
            <div class="lg:flex lg:flex-row justify-between">
                <div class="mt-6">
                    <x-jet-label for="transaction_receipt" value="{{ __('Transaction Receipt') }}"/>
                    <x-jet-input id="transaction_receipt" class="block mt-1 w-full overflow-ellipsis overflow-hidden"
                                 type="file"
                                 name="transaction_receipt" required
                                 :value="old('transaction_receipt')"/>
                </div>
            </div>
            <div class="flex items-center justify-end mt-6">
                <x-jet-button class="ml-4">
                    {{ __('Submit') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</div>

</body>
</html>
