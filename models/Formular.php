<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
//phpinfo();
$link = mysqli_connect(
    "localhost", // Host der Datenbank
    "root", // Benutzername zur Anmeldung
    "hassen", // Passwort zur Anmeldung
    "emensawerbeseite" // Auswahl der Datenbank
); // Optional: Port der Datenbank,
// falls nicht 3306 verwendet wird
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();

}
else{
    echo'yes';
}

echo '<form  method="POST">
<label for="name" > <small>Ihr Name: </small></label>
<input id="name" type="text" name="name" placeholder="name" ><br>
<label for="email" > <small>Ihr Mail: </small></label>
<input id="email" type="text" name="mail" placeholder="Email"  ><br>
<label for="beschreibung" > <small>Beschreibung des Gerichts: </small></label>
<input id="beschreibung" type="text" name="beschreibung" placeholder="Beschreibung" required><br>
<label for="name_gericht" > <small>Name des Gerichts: </small></label>
<input id="name-gericht" type="text" name="name_gericht" placeholder="Name von Gericht" required><br>
<label for="erstellungsdatum" > <small>Erstellungsdatum: </small></label>
<input id="erstellungsdatum" type="text" name="erstellungsdatum" placeholder="Erstellungsdatum" required><br>
<input type="submit" value="Wunsche abschicken" name="submit"><br>

<a href="wunschgericht.php"> zurück</a>
</form>';

if(isset($_POST['submit'])) {


    if(!isset($_POST['name']))
        $name="anonym";

    $name = $_POST['name'] ?? null;
    $name =mysqli_real_escape_string($link,$name);
    $mail = $_POST['mail'] ?? null;
    $mail =mysqli_real_escape_string($link,$mail);
    $beschreibung = $_POST['beschreibung']?? null;
    $beschreibung =mysqli_real_escape_string($link,$beschreibung);
    $name_gericht = $_POST['name_gericht']?? null;
    $name_gericht =mysqli_real_escape_string($link,$name_gericht);
    $erstellungsdatum = $_POST['erstellungsdatum']??null;
    $erstellungsdatum=mysqli_real_escape_string($link,$erstellungsdatum);


   // $statement = mysqli_stmt_init($link);
   //mysqli_stmt_prepare($statement,"INSERT INTO wunschgericht(name,erstellungsdatum,beschreibung,name_der_ersteller,email_der_ersteller) VALUES (?,?,?, ?, ?)");
    //mysqli_stmt_bind_param($statement,'sssss',$name_gericht, $erstellungsdatum, $beschreibung,$name,$mail);
    ////mysqli_stmt_execute($statement);
    ///
    $sql = " INSERT INTO wunschgericht(nummer,name,erstellungsdatum,beschreibung,name_der_ersteller,`e-mail_der_ersteller`) VALUES
 (last_insert_id(),'$name_gericht','$erstellungsdatum','$beschreibung','$name','$mail');";
    mysqli_query($link, $sql);
    if ($link->query($sql) === TRUE) {
        echo "New suggestion created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}

//Tabelle
$sql1 = "SELECT nummer,name,erstellungsdatum, beschreibung ,name_der_ersteller,`e-mail_der_ersteller` FROM wunschgericht LIMIT 5";
$result = mysqli_query($link, $sql1);
echo '<table border="red">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>',
    '<td>', $row['nummer'], '</td>',
    '<td>', $row['name'], '</td>',
    '<td>', $row['erstellungsdatum'], '</td>',
    ' <td>', $row['beschreibung'], '</td>',
    '<td>', $row['name_der_ersteller'], '</td>',
    '<td>', $row['e-mail_der_ersteller'], '</td>',
    '</tr>';
}
echo '</table>';


$link->close()

?>
