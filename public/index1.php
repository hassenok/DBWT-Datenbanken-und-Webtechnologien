
<?php
session_start();

if(isset($_SESSION['views']))
    $_SESSION['views'] ++;
else
    $_SESSION['views']=1;

echo"views = ".$_SESSION['views']."<br>";
if(isset($_POST['submit'])){
    $_SESSION['anm']++;
}
else
    $_SESSION['anm']=1;
//print_r($_SESSION);
echo "Die Anzahl der gespeicherten Anmeldungen= ".$_SESSION['anm'];


?>
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

    <?php
    $meals="";
    include 'aufgabe.php';

    foreach($meals as $value){
        echo "<tr><th>{$value['description']} <img src={$value['bilddatei']} width=200 height=150></td></th>
                      <th class='angaben'>{$value['price_intern']} </th>
                      <th class='angaben'>{$value['price_extern']}</th>
                  </tr>";
    }
    ?>
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
    <input type="submit" value="Zum Newsletter anmelden" name="submit"><span><?php
        //include 'bewerbung.php';
        //echo $_POST['Zustimmungfehler'] ?></span>
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
<?php
$link=mysqli_connect(
        "localhost",
    "root",
    "hassen",
    "emensawerbeseite"
);
if(!$link){
    echo" Verbindung fehlergeschlagen", mysqli_connect_errno();
}
$sql="SELECT name ,preis_intern ,preis_extern    FROM gericht 
ORDER BY name LIMIT 5 ";

$result=mysqli_query($link,$sql);
echo'<table border="red">';
echo '<tr>',
'<td>',
    'Name',
'</td>',
'<td>',
    'intern_Preis',
'</td>',
'<td>',
    'extern_Preis',
'</td>';
echo '</tr>';
while ($row=mysqli_fetch_assoc($result)){
    echo '<tr>',
    '<td>',
    $row['name'],
    '</td>',
        '<td>',
    $row['preis_intern'],
    '</td>',
    '<td>',
    $row['preis_extern'],
    '</td>';

    echo '</tr>';
}
echo'</table>';

    $sql=
        "SELECT DISTINCT gericht.name,preis_intern,preis_extern,GROUP_CONCAT( DISTINCT allergen.code) 
FROM gericht LEFT JOIN gericht_hat_allergen
                       ON gericht.id = gericht_hat_allergen.gericht_id
             LEFT JOIN  allergen
                        ON gericht_hat_allergen.code = allergen.code
GROUP BY gericht.name
LIMIT 5";

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo "Fehler während der Abfrage:  ", mysqli_error($link);
        exit();
    }
    echo"<br><br>";
echo "<table border='red'>";
echo '<tr>',
'<td>',
'Name',
'</td>',
'<td>',
'intern_Preis',
'</td>',
'<td>',
'extern_Preis',
'</td>',
'<td>',
'Allergene',
'</td>';
echo '</tr>';
    while ($row = mysqli_fetch_assoc($result)) {

        $pricei = number_format($row['preis_intern'],2,',', '.');
        $pricei .= "€";
        $pricee = number_format($row['preis_extern'],2,',', '.');
        $pricee .= "€";
        echo "<tr><td>".$row['name']."</td><td>".$pricei."</td><td>".$pricee."</td><td>".$row['GROUP_CONCAT( DISTINCT allergen.code)']."</td></tr>";
    }
echo"</table>";
    mysqli_free_result($result);
$sql=
    "SELECT DISTINCT gericht.name,GROUP_CONCAT( DISTINCT allergen.name) 
FROM gericht LEFT JOIN gericht_hat_allergen
                       ON gericht.id = gericht_hat_allergen.gericht_id
             LEFT JOIN  allergen
                        ON gericht_hat_allergen.code = allergen.code
GROUP BY gericht.name
LIMIT 5";
$result=mysqli_query($link,$sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
echo"<br><br>";
while ($row = mysqli_fetch_assoc($result)) {


    echo $row['name']."<br><ul style='color: turquoise'><li>".$row['GROUP_CONCAT( DISTINCT allergen.name)']."</li></ul>";
}
?>
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
</body>
</html>
