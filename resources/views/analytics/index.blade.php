<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex  justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Analytics') }}
            </h2>
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <div
                    class="px-3 bg-red-200 text-red-500 rounded alert">{{\Illuminate\Support\Facades\Session::get('error')}}</div>
            @elseif(\Illuminate\Support\Facades\Session::has('success'))
                <div
                    class="px-3 bg-green-200 text-green-500 rounded alert">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
            @endif
        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 bg-teal-300">
                        <div class="flex items-center">
                            <div class="rounded-full h-16 w-16 bg-white items-center justify-center flex">
                                <img src="{{asset('storage/images/group.svg')}}" alt=""
                                     class="w-8 h-8 fill-current text-gray-400">
                            </div>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total Registered:
                                {{$analytics['total_registered']}}</div>

                        </div>
                    </div>
                    <div class="p-6 bg-green-300">
                        <div class="flex items-center">
                            <div class="rounded-full h-16 w-16 bg-white items-center justify-center flex">
                                <img src="{{asset('storage/images/credit-card.svg')}}" alt=""
                                     class="w-16 h-16 fill-current text-gray-400">
                            </div>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total Paid:
                                {{$analytics['total_paid']}}</div>
                        </div>
                    </div>
                    <div class="p-6 bg-red-300 lg:col-span-2">
                        <div class="flex items-center">
                            <div class="rounded-full h-16 w-16 bg-white items-center justify-center flex">
                                <img src="{{asset('storage/images/credit-card (1).svg')}}" alt=""
                                     class="w-16 h-16 fill-current text-gray-400">
                            </div>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Total Unpaid:
                                {{$analytics['total_unpaid']}}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

