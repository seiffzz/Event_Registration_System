
<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <img src="{{asset('storage/images/group.svg')}}" alt="" class="w-8 h-8 fill-current text-gray-400">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold hover:text-blue-500"><a href="{{route('delegates.index')}}">Delegates</a>
            </div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <ul style="list-style-type:disc">
                    <li>View Profiles</li>
                    <li>Send Confirmation Mails</li>
                    <li>Send Payment Mails</li>
                    <li>Accept payments</li>
                    <li>Check-In</li>
                </ul>

            </div>
        </div>
    </div>

    @role('admin')
    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <img src="{{asset('storage/images/google-sheets.svg')}}" alt="" class="w-8 h-8 fill-current text-gray-400">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold hover:text-blue-500"><a
                    href="{{route('exports.index')}}">Export Center</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <ul style="list-style-type:disc">
                    <li>Export Paid Delegates</li>
                    <li>Export Unpaid Delegates</li>
                    <li>Export Registered Delegates</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <img src="{{asset('storage/images/analytics.svg')}}" alt="" class="w-8 h-8 fill-current text-gray-400">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold hover:text-blue-500"><a
                    href="{{route('analytics.index')}}">Analytics</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <ul style="list-style-type:disc">
                    <li>Total Paid</li>
                    <li>Total Unpaid</li>
                    <li>Total Registered</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <img src="{{asset('storage/images/group.svg')}}" alt="" class="w-8 h-8 fill-current text-gray-400">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold hover:text-blue-500"><a
                    href="{{route('imports.index')}}">Accepted Delegates</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <ul style="list-style-type:disc">
                    <li>Import Names And Emails Of Accepted Delegates From Excel Sheet</li>
                    <li>Send Personalized Registration From Links To Them</li>
                </ul>
            </div>
        </div>
    </div>
    @endrole
    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <img src="{{asset('storage/images/room.svg')}}" alt="" class="w-8 h-8 fill-current text-gray-400">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold hover:text-blue-500"><a
                    href="{{route('rooms.index')}}">Rooms</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <ul style="list-style-type:disc">
                    <li>View All Rooms</li>
                    <li>Set the Room Number</li>
                    <li>Checkout Delegates</li>
                </ul>
            </div>
        </div>
    </div>
</div>
