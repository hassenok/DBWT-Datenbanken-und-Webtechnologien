<?php
function selectfrom1(){
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
    $sql="SELECT name ,preis_intern ,preis_extern    FROM gericht
    ORDER BY name LIMIT 5 ";

     $result=mysqli_query($link,$sql);
    return $result;
}
function selectfrom2(){
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
    return $result;
}
function selectfrom3(){
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
    return $result;
}