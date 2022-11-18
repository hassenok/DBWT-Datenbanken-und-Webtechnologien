@if(!$test1)
<form method="get"  action="/fillthebewertung">
    {{$gerichtname}} :
    <img src="img/gerichte/{{$bildname}}" height="150" width="150"><br>
    <label for="Bemerkung"> Bemerkung : </label>
    <input id="Bemerkung" name="bemerkung" type="text" placeholder="Bemerkung">
    <br>
    <label for="Sterne_"> Sterne_Bewertung </label>
    <select id="Sterne" name="sterne">
        <option value="sehr gut">sehr gut</option>
        <option value="gut"> gut</option>
        <option value=" schlecht"> schlecht</option>
        <option value="sehr schlecht">sehr schlecht </option>
    </select>
    <label for="id"> ID : </label>
    <input id="id" name="id" type="text" >
    <input type="submit" value="Bewerten" name="submit" style="color:steelblue">





</form>
@endif

@if($test1)
<br><br><br>
<table>
    <tr><th>id</th><th>Bemerkung</th><th>Sterne-Bewertung</th><th>Bewertungszeitpunkt</th><th>Bewerber_id</th></tr>
    @while ($row=mysqli_fetch_assoc($bewertungen))

        <tr>


            <th>{{$row['id']}}</th>
            <th>{{$row['Bemmerkung']}}</th>
            <th>{{$row['Sterne-Bewertung']}}</th>
            <th>{{$row['Bewertungszeitpunkt']}}</th>
            <th>{{$row['Bewerber-id']}}</th>
            @if($privat)<th><a href="/meinebewertungen?bewertid={{$row['id']}}&id={{$row['Bewerber-id']}}" >löschen</a></th>@endif
            @if($testadmin)<th><a href="/bewertungen?bewertid={{$row['id']}}&id={{$row['Bewerber-id']}}" >hervorheben</a></th>@endif


        </tr>
    @endwhile
</table>
    @endif
