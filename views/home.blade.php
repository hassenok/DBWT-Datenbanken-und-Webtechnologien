@extends("layout")

@section("cssextra")

@endsection


@section("content1")
        <!DOCTYPE html>
    <!--
    - Praktikum DBWT. Autoren:
    - Ali , Ayadi , 3276402
    - Hassen , Trabelsi , 3286633
    -->


    <html lang="de">



    <head>
        <meta charset="UTF-8">
        <title>werbeseite</title>
        <link rel="stylesheet" href="css/styling.css">

    </head>

    <body >

    @if($test)
<p style="padding-left: 500px">angemeldet als {{$name}} mit dem ID :{{$id}} </p>
<p1 style="padding-left: 500px"><a href="/abmeldung">abmelden</a> </p1>
@endif
    <table><tr><th>id</th><th>Bemerkung</th><th>Sterne-Bewertung</th><th>Bewertungszeitpunkt</th><th>Bewerber_id</th></tr>
    @while ($row=mysqli_fetch_assoc($dataxx))
        <tr>


            <th>{{$row['id']}}</th>
            <th>{{$row['Bemmerkung']}}</th>
            <th>{{$row['Sterne-Bewertung']}}</th>
            <th>{{$row['Bewertungszeitpunkt']}}</th>
            <th>{{$row['Bewerber-id']}}</th>
            @if($testadmin)<th><a href="/delete?bewertid={{$row['id']}}" >Hervorhebung abwählen</a></th>@endif
        </tr>
    @endwhile
    </table>
    <div class="text">
        <div class="logo">E-Mensa Logo</div>
        <div class="menu">
            <a href="#Ankündigung"> Ankündigung  </a>&nbsp;
            <a href="#Speisen"> Speisen  </a >&nbsp;
            <a href="#Zahlen"> Zahlen </a>&nbsp;
            <a href="#Kontakt"> Kontakt </a>&nbsp;
            <a href="#Wichtig">wichtig fur uns </a>
        </div>
    </div>
    <hr style="width: 104%">
    <img src="img/emennnsa.jpg" alt="E-Mensa" width="490px"  >
    <h1 id="Ankündigung" ><strong>Bald gibt es Essen auch online ;)</strong></h1>
    <fieldset>
        A paragraph is a series of sentences that are organized and coherent, and are all related to a single topic.
        Almost every piece of writing you do that is longer than a few sentences should be organized into paragraphs.
        This is because paragraphs show a reader where the subdivisions of an essay begin and end, and thus help the reader
        see the organization of the essay and grasp its main
    </fieldset>
    <h1 id="Speisen"><strong>Kostlichkeiten, die Sie erwarten</strong></h1>
    <table>
        <tr>
            <th></th>
            <th class="titel">Preis intern</th>
            <th class="titel">Preis extern</th>
        </tr>
        <tr>

            <th> <br> Und rotem Paprika,dazu mit Nudeln</th>
            <th>3,50 &euro;</th>
            <th>6,20&euro;</th>

        </tr>

        @php
        $meals="";
        include 'aufgabe.php';

        foreach($meals as $value){
            echo "<tr><th>{$value['description']} <img src={$value['bilddatei']} width=200 height=150></td></th>
                      <th class='angaben'>{$value['price_intern']} </th>
                      <th class='angaben'>{$value['price_extern']}</th>
                  </tr>";
        }
        @endphp
    </table>
    <h1 id="Zahlen"><strong>E-Mensa in Zahlen</strong></h1>

    <div id="grid-container">
        <div>X Besuche</div>
        <div>y Anmeldungen zum <br> Newsletter </div>
        <div> z Speisen </div>
    </div>


    <h1 id="Kontakt"><strong>Interesse geweckt? wir informieren Sie!</strong></h1>

    <form method="post" action="bewerbung.php">
        <div class="kontakt">
            <label for="Vorname" > <small>Ihr Name: </small></label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="email" ><small> Ihre E-Mail:</small></label>  &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="Newsletter" ><small> Newsletter bitte in: </small></label> <br>
        </div>
        <div class="placeholders">
            <input id="Vorname" type="text" name="vorname" placeholder="Vorname" >

            <input id="email" type="text" name="Email"   >

            <select id="Newsletter" name="Sprache" >
                <option value="English"> English </option>
                <option value="Deutsch" selected> Deutsch </option>
                <option value="Französisch"> Francais </option>
            </select>
            <br>
        </div>
        <br>
        <div class="checkbox">
            <input type="checkbox" id="Datenschutzstimmungen" name="zustimmen">
            <label for="Datenschutzstimmungen"> <small>Den Datenschutzstimmungen stimme ich zu</small> &nbsp;</label>
            <input type="submit" value="Zum Newsletter anmelden" name="submit"><span>@php
                //include 'bewerbung.php';
                //echo $_POST['Zustimmungfehler'] @endphp</span>
        </div>

    </form >
    <h1 id="Wichtig"> Das ist uns wichtig</h1>
    <ul class="haupt">
        <li> Best frische Zutaten </li>
        <li> Ausgewogene abwechslungsreiche Gerichte </li>
        <li> Sauberkeit </li>
    </ul>
    <br> <br>
    <h1 class="end"> Wir freuen uns auf Ihren Besuch!</h1>
    <hr style="width: 104%">


    <footer>
        <ul>

            <li class="mensa">(c) Mensa GmbH </li>
            <li class="namen">Ali Ayadi , Hassen Trabelsi</li>
            <li class="impressum"><a href="">Impressum </a></li>
        </ul>
    </footer>
    <p> to show All Meals and Prices type "localhost:9000/tabelle" in URL </p>

    <br>
    GERICHTE MIT BILDERN :
    <table>
        @while ($row=mysqli_fetch_assoc($data))
            <tr>


                <th>{{$row['name']}}</th>
                <th><img   src="img/gerichte/{{$row['bildname']}} " width="200" height="150"></th>
                @if($test)<th> <a href="/bewertung?gerichtid={{$row['id']}}">zur Bewertung </a></th>@endif
            </tr>
        @endwhile
    </table>





    </body>
    </html>
@endsection