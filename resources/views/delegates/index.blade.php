<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Delegates') }}
            </h2>
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <div
                    class="px-3 bg-red-200 text-red-500 rounded alert lg:block hidden">{{\Illuminate\Support\Facades\Session::get('error')}}</div>
                <div class="px-3 bg-red-200 text-red-500 rounded alert lg:hidden block">Error!</div>
                {{\Illuminate\Support\Facades\Session::forget('error')}}
            @elseif(\Illuminate\Support\Facades\Session::has('success'))
                <div
                    class="px-3 bg-green-200 text-green-500 rounded alert lg:block hidden">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
                <div class="px-3 bg-green-200 text-green-500 rounded alert lg:hidden block">Success!</div>
                {{\Illuminate\Support\Facades\Session::forget('success')}}
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
                            type="button" id="select-all" onclick="select_all()">Select All
                        </button>
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="print" onclick="select_operation('profile')">View Profile
                        </button>
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="print" onclick="select_operation('create_room')">Create Room
                        </button>
                        {{--                        <button--}}
                        {{--                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"--}}
                        {{--                            type="submit" form="form" id="payment_mail" onclick="select_operation('payment_mail')">Send--}}
                        {{--                            Payment Mail--}}
                        {{--                        </button>--}}
                        {{--                        <button--}}
                        {{--                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"--}}
                        {{--                            type="submit" form="form" id="confirmation_mail"--}}
                        {{--                            onclick="select_operation('confirmation_mail')">Send--}}
                        {{--                            Confirmation Mail--}}
                        {{--                        </button>--}}
                        @role('admin')
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="paid" onclick="select_operation('paid')">Mark
                            Paid
                        </button>
                        @endrole
                        @role('admin')
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="unpaid" onclick="select_operation('unpaid')">Mark
                            Unpaid
                        </button>
                        @endrole
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="mark_checked_in"
                            onclick="select_operation('mark_checked_in')">Mark
                            Checked-In
                        </button>
                        @role('admin')
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="mark_checked_in"
                            onclick="select_operation('mark_unchecked_in')">Mark
                            Unchecked-In
                        </button>
                        @endrole


                        @role('admin')
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" form="form" id="edit" onclick="select_operation('edit')">Edit
                        </button>
                        <button
                            class="px-3 text-sm py-2 text-center bg-red-500 rounded font-bold text-white  hover:bg-red-400"
                            type="submit"
                            form="form" id="delete" onclick="select_operation('delete')">Delete
                        </button>
                        @endrole

                    </div>
                    <form action="{{route('delegates.index')}}" id="form">
                        <table id="example" class="hover row-border" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                {{--<th class="text-center">Phone Number</th>--}}
                                <th class="text-center">Gender</th>
                                {{--<th class="text-center">LC</th>--}}
                                <th class="text-center">Role</th>
                                {{--<th class="text-center">Function</th>--}}
                                {{--<th class="text-center">Event</th>--}}
                                {{--<th class="text-center">Received Payment Mail</th>--}}
                                <th class="text-center">Paid</th>
                                {{--<th class="text-center">Received Confirmation Mail</th>--}}
                                <th class="text-center">Checked In</th>
                                {{--<th class="text-center">Meals Counter</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($delegates as $delegate)
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" name="selected[]"
                                               value="{{$delegate->id}}"/>
                                    </th>
                                    <th class="text-center">{{$delegate->name}}</th>
                                    <th class="text-center">{{$delegate->email}}</th>
                                    {{--<th class="text-center">{{$delegate->phone_number}}</th>--}}
                                    <th class="text-center">{{$delegate->gender}}</th>
                                    {{--<th class="text-center">{{$delegate->lc}}</th>--}}
                                    <th class="text-center">{{$delegate->role}}</th>
                                    {{--<th class="text-center">{{$delegate->function}}</th>--}}
                                    {{--<th class="text-center">{{$delegate->event}}</th>--}}
                                    {{--<th class="justify-center">@if($delegate->received_payment_mail == 1)<img--}}
                                    {{--src="{{asset('storage/images/check.svg')}}" alt="" width="20px"--}}
                                    {{--height="20px" style="height: 64px;margin: auto">--}}
                                    {{--<div class="hidden">yespaymentmail</div> @else <img--}}
                                    {{--src="{{asset('storage/images/cancel-mark.svg')}}"--}}
                                    {{--alt="" width="20px" height="20px" style="height: 64px;margin: auto">--}}
                                    {{--<div class="hidden">nopaymentmail</div> @endif--}}
                                    {{--</th>--}}
                                    <th class="justify-center">@if($delegate->paid == 1)<img
                                            src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                            height="20px" style="height: 64px;margin: auto">
                                        <div class="hidden">yespaid</div> @else <img
                                            src="{{asset('storage/images/cancel-mark.svg')}}"
                                            alt="" width="20px" style="height: 64px;margin: auto">
                                        <div class="hidden">nopaid</div> @endif</th>
                                    {{--<th class="justify-center">@if($delegate->received_confirmation_mail == 1)<img--}}
                                    {{--src="{{asset('storage/images/check.svg')}}" alt="" width="20px"--}}
                                    {{--height="20px" style="height: 64px;margin: auto">--}}
                                    {{--<div class="hidden">yesconfirmationmail</div> @else <img--}}
                                    {{--src="{{asset('storage/images/cancel-mark.svg')}}"--}}
                                    {{--alt="" width="20px" height="20px" style="height: 64px;margin: auto">--}}
                                    {{--<div class="hidden">noconfirmationmail</div> @endif--}}
                                    {{--</th>--}}
                                    <th class="justify-center">@if($delegate->checked_in == 1)<img
                                            src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                            height="20px" style="height: 64px;margin: auto">
                                        <div class="hidden">yescheckin</div> @else <img
                                            src="{{asset('storage/images/cancel-mark.svg')}}"
                                            alt="" width="20px" height="20px" style="height: 64px;margin: auto">
                                        <div class="hidden">nocheckin</div> @endif
                                    </th>
                                    {{--<th class="justify-center">{{$delegate->meals_counter}}</th>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function select_operation(operation) {
        if (operation == 'create_room') {
            document.getElementById('form').action = '{{route('rooms.create_room')}}'
            // document.getElementById('form').target = 'blank'
        } else if (operation == 'paid') {
            document.getElementById('form').action = '{{route('delegates.mark_paid')}}'
        } else if (operation == 'confirmation_mail') {
            document.getElementById('form').action = '{{route('delegates.send_confirmation_emails')}}'
        } else if (operation == 'delete') {
            document.getElementById('form').action = '{{route('delegates.delete')}}'
        } else if (operation == 'edit') {
            document.getElementById('form').action = '{{route('delegates.edit')}}'
        } else if (operation == 'payment_mail') {
            document.getElementById('form').action = '{{route('delegates.send_payment_emails')}}'
        } else if (operation == 'profile') {
            document.getElementById('form').action = '{{route('delegates.profile')}}'
        } else if (operation == 'mark_checked_in') {
            document.getElementById('form').action = '{{route('delegates.mark_checked_in')}}'
        } else if (operation == 'unpaid') {
            document.getElementById('form').action = '{{route('delegates.mark_unpaid')}}'
        } else if (operation == 'mark_unchecked_in') {
            document.getElementById('form').action = '{{route('delegates.mark_unchecked_in')}}'
        }
    }

    function select_all() {
        flip_name()
        $('input:checkbox').each(function () {
            this.checked = !this.checked
        })
    }

    function flip_name(name1, name2) {
        if ($('#select-all').text() == 'Deselect All') {
            $('#select-all').text('Select All')
        } else {
            $('#select-all').text('Deselect All')
        }
    }
</script>
