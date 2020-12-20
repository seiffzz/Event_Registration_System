<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rooms') }}
            </h2>
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <div
                    class="px-3 bg-red-200 text-red-500 rounded alert lg:block hidden">{{\Illuminate\Support\Facades\Session::get('error')}}</div>
                <div class="px-3 bg-red-200 text-red-500 rounded alert lg:hidden block">Error!</div>
            @elseif(\Illuminate\Support\Facades\Session::has('success'))
                <div
                    class="px-3 bg-green-200 text-green-500 rounded alert lg:block hidden">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
                <div class="px-3 bg-green-200 text-green-500 rounded alert lg:hidden block">Success!</div>
            @endif
        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-10 px-5 w-full">

                    <table id="example" class="hover row-border" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">Room Number</th>
                            <th class="text-center">Capacity</th>
                            <th class="text-center">Checked_out</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr onclick="window.location.href='{{route('rooms.view_room',$room->id)}}'">
                                <th class="text-center">@if($room->room_number == null)Not Set
                                    Yet @else {{$room->room_number}} @endif</th>
                                <th class="text-center">{{$room->capacity}}</th>
                                <th class="justify-center">@if($room->checked_out == 1)<img
                                        src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                        height="20px" style="height: 64px;margin: auto">
                                    <div class="hidden">yescheckedout</div> @else <img
                                        src="{{asset('storage/images/cancel-mark.svg')}}"
                                        alt="" width="20px" style="height: 64px;margin: auto">
                                    <div class="hidden">nocheckedout</div> @endif</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

