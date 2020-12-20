<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if($data['room']->room_number != null){{ __('Room '.$data['room']->room_number) }}
                @else
                    {{__('Room')}}
                @endif
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
                    <div class="flex lg:justify-center flex-row mb-10 lg:overflow-x-hidden overflow-x-auto">
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white mr-3 hover:bg-blue-400"
                            type="button" id="print_room"
                            onclick="window.location.href='{{route('rooms.print',$data['room']->id)}}'">Print Room
                        </button>
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400 modal-open"
                            type="submit" form="form" id="room_number">Set Room Number
                        </button>
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="mark_delegate1"
                            onclick="window.location.href='{{route('rooms.check_out',$data['room']->delegate1)}}'">Mark
                            Delegate 1 Checked-out
                        </button>
                        @if($data['room']->capacity ==2)
                            <button
                                class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                                type="submit" form="form" id="mark_delegate2"
                                onclick="window.location.href='{{route('rooms.check_out',$data['room']->delegate2)}}'">
                                Mark Delegate 2 Checked-out
                            </button>
                        @endif
                        @if($data['checked_out'] == true)
                            <button
                                class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                                type="submit" form="form" id="mark_delegate1"
                                onclick="window.location.href='{{route('rooms.mark_room',$data['room']->id)}}'">Mark
                                Room Checked-out
                            </button>
                        @else
                            <button
                                class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400 disabled"
                                type="submit" form="form" id="mark_delegate1"
                                onclick="window.location.href='{{route('rooms.mark_room',$data['room']->id)}}'">Mark
                                Room Checked-out
                            </button>
                        @endif
                    </div>
                    <div class="lg:overflow-hidden overflow-auto">
                        <table class="lg:table-fixed border-collapse border-2 border-gray-600 text-center w-full">
                            <thead>
                            <tr>
                                <th class="w-1/5 border-2 border-gray-600 text-center"></th>
                                <th onclick="window.location.href='{{route('delegates.profile',['id'=>$data['delegate1']->id])}}'"
                                    class="lg:w-2/5 border-2 border-gray-600 text-center text-lg py-3 px-2 font-bold hover:text-blue-500 cursor-pointer">
                                    Delegate 1
                                </th>
                                @if($data['room']->capacity ==2)
                                    <th onclick="window.location.href='{{route('delegates.profile',['id'=>$data['delegate2']->id])}}'"
                                        class="lg:w-2/5 border-2 border-gray-600 text-center text-lg py-3 px-2 font-bold hover:text-blue-500 cursor-pointer">
                                        Delegate 2
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border-2 border-gray-600 text-center font-bold py-3">Name</td>
                                <td class="border-2 border-gray-600 text-center py-3 px-2 overflow-ellipsis">{{$data['delegate1']->name}}</td>
                                @if($data['room']->capacity ==2)
                                    <td class="border-2 border-gray-600 text-center py-3 px-2 overflow-ellipsis">{{$data['delegate2']->name}}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="border-2 border-gray-600 text-center font-bold py-3 px-2">Checked-out</td>
                                <th class="justify-center border-2 border-gray-600">
                                    @if($data['delegate1']->checked_out == 1)<img
                                        src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                        height="20px" style="height: 64px;margin: auto">
                                    @else <img
                                        src="{{asset('storage/images/cancel-mark.svg')}}"
                                        alt="" width="20px" style="height: 64px;margin: auto">
                                    @endif</th>
                                @if($data['room']->capacity ==2)
                                    <th class="justify-center border-2 border-gray-600">
                                        @if($data['delegate2']->checked_out == 1)<img
                                            src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                            height="20px" style="height: 64px;margin: auto">
                                        @else <img
                                            src="{{asset('storage/images/cancel-mark.svg')}}"
                                            alt="" width="20px" style="height: 64px;margin: auto">
                                        @endif</th>
                                @endif
                            </tr>
                            <tr>
                                <td class="border-2 border-gray-600 text-center font-bold py-3 px-2">Checked-in</td>
                                <th class="justify-center border-2 border-gray-600">
                                    @if($data['delegate1']->checked_in == 1)<img
                                        src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                        height="20px" style="height: 64px;margin: auto">
                                    @else <img
                                        src="{{asset('storage/images/cancel-mark.svg')}}"
                                        alt="" width="20px" style="height: 64px;margin: auto">
                                    @endif</th>
                                @if($data['room']->capacity ==2)
                                    <th class="justify-center border-2 border-gray-600">
                                        @if($data['delegate2']->checked_in == 1)<img
                                            src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                            height="20px" style="height: 64px;margin: auto">
                                        @else <img
                                            src="{{asset('storage/images/cancel-mark.svg')}}"
                                            alt="" width="20px" style="height: 64px;margin: auto">
                                        @endif</th>
                                @endif
                            </tr>
                            <tr>
                                <td class="border-2 border-gray-600 text-center font-bold py-3 px-2">ID</td>
                                <td class="border-2 border-gray-600 text-center py-3">
                                    <div class="flex lg:flex-row flex-col justify-center items-center">
                                        <img class="lg:mr-5 lg:mb-0 mb-5"
                                             src="{{asset('storage/ids/'.$data['delegate1']->id_front)}}"
                                             alt="" width="45%">
                                        <img src="{{asset('storage/ids/'. $data['delegate1']->id_back)}}" alt=""
                                             width="45%">
                                    </div>
                                </td>
                                @if($data['room']->capacity ==2)
                                    <td class="border-2 border-gray-600 text-center">
                                        <div class="flex lg:flex-row flex-col justify-center items-center">
                                            <img class="lg:mr-5 lg:mb-0 mb-5"
                                                 src="{{asset('storage/ids/'.$data['delegate2']->id_front)}}"
                                                 alt="" width="45%">
                                            <img src="{{asset('storage/ids/'. $data['delegate2']->id_back)}}" alt=""
                                                 width="45%">
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td class="border-2 border-gray-600 text-center font-bold py-3 px-2">Phone Number</td>
                                <td class="border-2 border-gray-600 text-center py-3 px-2">{{$data['delegate1']->phone_number}}</td>
                                @if($data['room']->capacity == 2)
                                    <td class="border-2 border-gray-600 text-center py-3 px-2">{{$data['delegate2']->phone_number}}</td>
                                @endif

                            </tr>
                            <tr>
                                <td class="border-2 border-gray-600 text-center font-bold py-3 px-2">Email</td>
                                <td class="border-2 border-gray-600 text-center py-3 px-2 overflow-ellipsis">{{$data['delegate1']->email}}</td>
                                @if($data['room']->capacity == 2)
                                    <td class="border-2 border-gray-600 text-center py-3 px-2 overflow-ellipsis">{{$data['delegate2']->email}}</td>
                                @endif
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
    @livewire('modal',['room_id'=>$data['room']->id])
    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function (event) {
                event.preventDefault()
                toggleModal()
            })
        }

        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function (evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }


    </script>

</x-app-layout>
