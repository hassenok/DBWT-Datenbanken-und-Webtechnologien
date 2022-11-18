<html>
<head>
    <meta charset="UTF-8">
    <title>
       Namen und interne Preise von Gerichten
    </title>
</head>
<body>

@foreach($data as $a)
    @if($a['preis_intern']>2)
        <li >{{$a['name']}}. -> .{{$a['preis_intern']}}</li>

    @endif


@endforeach
@empty($data)
    <p> Es sind keine Gerichte vorhanden </p>
@endempty



</body>
</html>
