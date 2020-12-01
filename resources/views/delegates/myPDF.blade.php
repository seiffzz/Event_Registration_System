<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Room</title>

    {{--    <!-- Styles -->--}}
{{--        <link rel="stylesheet" href="{{ public_path('css/app.css') }}">--}}
</head>
<body>

<div style="width: 100%;overflow:hidden">
    <div style="width: 100%;display: flex;flex-direction: row;justify-content: space-between;margin-bottom: auto">
        @for($i=0,$iMax = count($data)/2;$i<$iMax;$i++)
            <div style="width: 100%;display: flex;flex-direction: row;padding-bottom: 40px">
                <img src="{{public_path('storage/ids/'.$data[$i])}}" alt="" style="width: 46%;padding-right: 30px">
                <img src="{{public_path('storage/ids/'.$data[$i+1])}}" alt="" style="width: 46%">
            </div>
        @endfor
{{--        <div style="width: 100%;display: flex;flex-direction: row;padding-bottom: 40px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[0])}}" alt="" style="width: 46%;padding-right: 30px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[1])}}" alt="" style="width: 46%">--}}
{{--        </div>--}}
{{--        <div style="width: 100%;display: flex;flex-direction: row;padding-bottom: 40px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[2])}}" alt="" style="width: 46%;padding-right: 30px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[3])}}" alt="" style="width: 46%">--}}
{{--        </div>--}}
    </div>
{{--    <div style="width: 100%;display: flex;flex-direction: row;justify-content: space-between">--}}
{{--        <div style="width: 46%;display: flex;flex-direction: row;padding-bottom: 40px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[0])}}" alt="" style="width: 46%;padding-right: 30px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[1])}}" alt="" style="width: 46%">--}}
{{--        </div>--}}
{{--        <div style="width: 46%;display: flex;flex-direction: row;padding-bottom: 40px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[2])}}" alt="" style="width: 46%;padding-right: 30px">--}}
{{--            <img src="{{public_path('storage/ids/'.$data[3])}}" alt="" style="width: 46%">--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
</body>
</html>
