<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-3">
            <div class="grid grid-cols-3 w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 w-full">
                <div class="lg:col-span-2 col-span-3 mb-10 lg:mb-0">

                    <div class="mb-10 grid grid-cols-2 rounded text-center border-2 border-blue-200">
                        <div class="px-3 py-2 font-bold text-lg border-b-2 border-blue-200">Name:</div>
                        <div class="px-3 py-2 text-lg border-b-2 border-blue-200">{{$data['delegate']->name}}</div>
                        {{--                        <div class="px-3 py-2 font-bold text-lg border-b-2 border-blue-200">Payment Method:</div>--}}
                        {{--                        <div class="px-3 py-2 text-lg border-b-2 border-blue-200">@if(isset($delegate->payment_method)){{$delegate->payment_method}} @else N/A @endif</div>--}}
                        {{--                        <div class="px-3 py-2 font-bold text-lg">Transaction Number:</div>--}}
                        {{--                        <div class="px-3 py-2 text-lg">@if(isset($delegate->payment_method)){{$delegate->transaction_number}} @else N/A @endif</div>--}}
                        <div
                            @isset($data['room_number'])onclick="window.location.href='{{route('rooms.view_room',$data['room_number']->id)}}'"
                            class="px-3 py-2 font-bold text-lg hover:text-blue-500 cursor-pointer"
                            @endisset
                            class="px-3 py-2 font-bold text-lg">
                            Room Number:
                        </div>
                        <div
                            class="px-3 py-2 text-lg">@if(isset($data['room_number']->room_number)){{$data['room_number']->room_number}}@else
                                Not Set Yet @endif</div>
                    </div>
                    <table class="min-w-full table-auto rounded">
                        <thead class="justify-between rounded">
                        </thead>
                        <tbody class="rounded">
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3 rounded-tl">Email</th>
                            <th class="bg-gray-200 py-3 rounded-tr">{{$data['delegate']->email}}</th>
                        </tr>
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3">Gender</th>
                            <th class="bg-gray-200 py-3">{{$data['delegate']->gender}}</th>
                        </tr>
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3">Date of Birth</th>
                            <th class="bg-gray-200 py-3">{{$data['delegate']->dob}}</th>
                        </tr>
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3">Phone Number</th>
                            <th class="bg-gray-200 py-3">{{$data['delegate']->phone_number}}</th>
                        </tr>
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3">Allergies</th>
                            <th class="bg-gray-200 py-3">@if($data['delegate']->allergies !== null){{$data['delegate']->allergies}} @else
                                    No Allergies @endif</th>
                        </tr>
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3">Role</th>
                            <th class="bg-gray-200 py-3">{{$data['delegate']->role}}</th>
                        </tr>
                        @if($data['delegate']->role != 'New Member' && $data['delegate']->role != 'Newbie')
                            <tr>
                                <th class="bg-gray-800 text-gray-300 font-bold py-3">Function</th>
                                <th class="bg-gray-200 py-3">{{$data['delegate']->function}}</th>
                            </tr>@endif

                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3">Paid</th>
                            <th class="bg-gray-200 py-3">@if($data['delegate']->paid == 1)<img
                                    src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                    height="20px" style="height: 64px;margin: auto"> @else <img
                                    src="{{asset('storage/images/cancel-mark.svg')}}"
                                    alt="" width="20px" style="height: 64px;margin: auto"> @endif</th>
                        </tr>
                        <tr>
                            <th class="bg-gray-800 text-gray-300 font-bold py-3 rounded-bl">Checked-In</th>
                            <th class="bg-gray-200 py-3 rounded-br">@if($data['delegate']->checked_in == 1)<img
                                    src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                    height="20px" style="height: 64px;margin: auto"> @else <img
                                    src="{{asset('storage/images/cancel-mark.svg')}}"
                                    alt="" width="20px" style="height: 64px;margin: auto"> @endif</th>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="flex flex-col lg:items-end w-full lg:col-span-1 col-span-3">
                    <img id="id_front_img" src="{{asset('storage/ids/'.$data['delegate']->id_front)}}" alt=""
                         class="mb-16 rounded w-full lg:w-5/6">
                    <img id="id_back_img" src="{{asset('storage/ids/'.$data['delegate']->id_back)}}" alt=""
                         class="mb-16 rounded w-full lg:w-5/6">
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
