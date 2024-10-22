{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <title>Tailwind CSS Modal</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        .modal {--}}
{{--            transition: opacity 0.25s ease;--}}
{{--        }--}}

{{--        body.modal-active {--}}
{{--            overflow-x: hidden;--}}
{{--            overflow-y: visible !important;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}

{{--<body class="bg-gray-200 flex items-center justify-center h-screen">--}}

{{--<!--Modal-->--}}
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

        <div
            class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                 viewBox="0 0 18 18">
                <path
                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Set Room Number</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <form action="{{route('rooms.edit_room_number',$room_id)}}">
                <x-jet-label for="room_number" value="{{ __('Room Number') }}"/>
                <x-jet-input id="room_number" class="block mt-1 w-full" type="text" name="room_number" required
                             :value="old('room_number')"/>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button type="button" class="modal-close px-3 bg-red-500 py-2 rounded-lg text-white hover:bg-red-400 mr-3">Close
                    </button>
                    <button
                        type="submit"
                        class="px-3 bg-blue-500 py-2 rounded-lg text-white hover:bg-blue-400">
                        Submit
                    </button>

                </div>
            </form>


        </div>
    </div>
</div>
{{--</body>--}}
{{--</html>--}}
