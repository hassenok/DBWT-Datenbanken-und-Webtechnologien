<html>
<head>
    <meta charset="UTF-8">
    <title>
        Kategorien
    </title>
</head>
<body>
@php
    sort($data);
@endphp
@foreach($data as $a)
    @if($loop->odd)
        <li style="font-weight: bold" >{{$a['name']}}</li>
    @else
        <li >{{$a['name']}}</li>
    @endif
@endforeach


</body>
</html>
