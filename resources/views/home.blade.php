<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@livewireStyles

<!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
{{--    @livewire('navigation-dropdown')--}} 

<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-jet-application-mark class="block h-9 w-auto"/>
                    </a>
                </div>

                <!-- Title -->
                <div class="space-x-8 -my-px ml-10 sm:flex self-center">
                    <div class="self-center"><h1 class="text-2xl text-gray-500 font-semibold">Events</h1></div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="lg:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-3 gap-10 p-20">
                    @foreach($events as $event)
                        <div class="card cursor-pointer" onclick="window.location.href='{{route('single',$event['id'])}}'">
                            <div class="max-w-sm rounded overflow-hidden shadow-lg card-content">
                                <img class="w-full h-40" src="{{asset('storage/event_images/'.$event['cover_image'])}}"
                                    alt="Sunset in the mountains">
                                <div class="px-6 py-4 flex flex-row justify-between">
                                    <div class="font-bold text-xl mb-2">{{$event['name']}}</div>
                                    <div class="text-lg float-right text-gray-500">{{$event['price']}} LE</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
