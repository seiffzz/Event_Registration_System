<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Accepted Delegates') }}
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
            @elseif(\Illuminate\Support\Facades\Session::has('warning'))
                <div onclick="toggleModal('modal-id')" class="px-3 bg-yellow-200 text-yellow-500 rounded alert block cursor-pointer underline hover:bg-yellow-300">Warning(s)!
                </div>
                @livewire('warning-modal',['message'=>\Illuminate\Support\Facades\Session::get('warning')])
                {{\Illuminate\Support\Facades\Session::forget('warning')}}
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
                        <form action="{{route('imports.import')}}" method="POST" enctype="multipart/form-data"
                              id="file-form">
                            @csrf
                            <input type="file" class="hidden" name="file" id="file"
                                   onchange="document.getElementById('file-form').submit()">
                            <button
                                class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                                type="button" id="print" onclick="choose_file()">Import Accepted Delegates
                            </button>

                        </form>
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" id="print" form="form-2" onclick="">Send Registration Mail
                        </button>
                        @role('admin')
                        <button
                            class="px-3 text-sm py-2 text-center bg-blue-500 rounded font-bold text-white  mr-3 hover:bg-blue-400"
                            type="submit" id="print" form="form-2" onclick="choose_operation('edit')">Edit
                        </button>
                        <button
                            class="px-3 text-sm py-2 text-center bg-red-500 rounded font-bold text-white  mr-3 hover:bg-red-400"
                            type="submit" id="print" form="form-2" onclick="choose_operation('delete')">Delete
                        </button>
                        @endrole
                    </div>
                    <form action="{{route('imports.send_registration_emails')}}" id="form-2">
                        <table id="example" class="hover row-border" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Received Registration Mail</th>
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
                                    <th class="text-center">{{$delegate->phone_number}}</th>
                                    <th class="text-center">{{$delegate->role}}</th>
                                    <th class="justify-center">@if($delegate->received_mail == 1)<img
                                            src="{{asset('storage/images/check.svg')}}" alt="" width="20px"
                                            height="20px" style="height: 64px;margin: auto">
                                        <div class="hidden">yesregistrationmail</div> @else <img
                                            src="{{asset('storage/images/cancel-mark.svg')}}"
                                            alt="" width="20px" height="20px" style="height: 64px;margin: auto">
                                        <div class="hidden">noregistrationmail</div> @endif
                                    </th>
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

    function choose_operation(operation) {
        if (operation == 'delete') {
            document.getElementById('form-2').action = '{{route('imports.delete')}}'
        } else if (operation == 'edit') {
            document.getElementById('form-2').action = '{{route('imports.edit')}}'
        }

    }

    function choose_file() {
        document.getElementById('file').click()
    }
</script>
