
@extends('layout')
@section('content2')
        <html>
    <table border="red">
    <tr>
        <td>
            Name
        </td>
        <td>
            intern_Preis
        </td>
        <td>
            extern_Preis
        </td>
    </tr>
    <tr>
            @while ($row=mysqli_fetch_assoc($data1))
            <td> {{$row['name']}},
        </td>
        <td>
            {{$row['preis_intern']}}€
        </td>
        <td>
            {{$row['preis_extern']}}€
        </td>

    </tr>
    @endwhile



</table>




<br><br>
<table border='red'>
    <tr>
        <td>
            Name
        </td>
        <td>
            intern_Preis
        </td>
        <td>
            extern_Preis
        </td>
        <td>
            Allergene
        </td>
    </tr>
    @while ($row = mysqli_fetch_assoc($data2))


        <tr><td>{{$row['name']}}</td><td>{{number_format($row['preis_intern'],2,',', '.')}}€ </td><td>{{number_format($row['preis_extern'],2,',', '.')}}€</td><td>{{$row['GROUP_CONCAT( DISTINCT allergen.code)']}}</td></tr>

    @endwhile
</table>

<br><br>
@while ($row = mysqli_fetch_assoc($data3))


    {{ $row['name']}}<br><ul style='color: turquoise'><li>{{$row['GROUP_CONCAT( DISTINCT allergen.name)']}}</li></ul>

@endwhile
    <html>
    <form method="get" action="nl-admin.php">
        <label for="search_text">Filter:</label>
        <input id="search_text" type="text" name="search_text">
        <input  value="search" name="search" type="submit">
    </form>
    <form method="get">
        <label for="sortieren">Sortieren absteigend nach:</label>
        <br>
        <select name="sort" id="sortieren">
            <option value="name">Name</option>
            <option value="email">Email</option>
        </select>
        <input type="submit">

    </form>
    </html>
        </html>
@endsection
