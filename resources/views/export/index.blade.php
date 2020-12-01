<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid lg:grid-cols-2">
                <div
                    class="p-6 border-t border-gray-200 md:border-t-0 md:border-l bg-teal-300 cursor-pointer hover:bg-teal-200"
                    onclick="window.location.href='{{route('exports.export_registered')}}'">
                    <div class="flex items-center">
                        <div class="rounded-full h-16 w-16 bg-white items-center justify-center flex">
                            <img src="{{asset('storage/images/group.svg')}}" alt=""
                                 class="w-8 h-8 fill-current text-gray-400">
                        </div>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Export
                            Registered Delegates
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-600">
                            <ul style="list-style-type:disc">
                                <li>Export All Registered Delegates to Excel Sheet</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="p-6 border-t border-gray-200 md:border-t-0 md:border-l bg-green-300 cursor-pointer hover:bg-green-200"
                    onclick="window.location.href='{{route('exports.export_paid')}}'">
                    <div class="flex items-center">
                        <div class="rounded-full h-16 w-16 bg-white items-center justify-center flex">
                            <img src="{{asset('storage/images/credit-card.svg')}}" alt=""
                                 class="w-16 h-16 fill-current text-gray-400">
                        </div>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Export
                            Paid Delegates
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-600">
                            <ul style="list-style-type:disc">
                                <li>Export All Paid Delegates to Excel Sheet</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div
                    class="p-6 border-t border-gray-200 md:border-t-0 md:border-l bg-red-300 lg:col-span-2 cursor-pointer hover:bg-red-200"
                    onclick="window.location.href='{{route('exports.export_unpaid')}}'">
                    <div class="flex items-center">
                        <div class="rounded-full h-16 w-16 bg-white items-center justify-center flex">
                            <img src="{{asset('storage/images/credit-card (1).svg')}}" alt=""
                                 class="w-16 h-16 fill-current text-gray-400">
                        </div>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Export
                            Unpaid Delegates
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-600">
                            <ul style="list-style-type:disc">
                                <li>Export All Unpaid Delegates to Excel Sheet</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

