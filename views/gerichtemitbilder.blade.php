@extends('layout')
@section('content4')


    <br>
    GERICHTE MIT BILDERN :
    <table>
        @while ($row=mysqli_fetch_assoc($data))
        <tr>

            <td>{{$row['name']}}</td>
            <td><img  src="img/gerichte/{{$row['bildname']}}"></td>


        </tr>
        @endwhile
    </table>
@endsection