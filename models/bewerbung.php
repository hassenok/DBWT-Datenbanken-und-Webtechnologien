<?php
/*
 * Praktikum DBWT. Autoren:
 * Ali , Ayadi , 3276402
 * Hassen , Trabelsi , 3286633
 */
include 'emensa/views/home.blade.php';
//echo '<pre>', var_dump($_POST), '</pre>';

if(isset($_POST['submit'])){
// Datei oeffnen




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['vorname'])) {
        $vorname = trim($_POST['vorname']);
        $Namefehler="";
    }

    if (empty($_POST['vorname'])){
        $Namefehler = "Name muss eingesetzt werden";
        echo $Namefehler."<br>";
    }

    //$zustimmen = isset($_POST['zustimmen']) ? trim($_POST['zustimmen']) : NULL;
    if (isset($_POST['zustimmen'])) {
        $zustimmen = trim($_POST['zustimmen']);
        $Zustimmungfehler="";
    }

    if (empty($_POST['zustimmen'])){
        $Zustimmungfehler = "Datenschtz zustimmen";
        echo $Zustimmungfehler."<br>";
    }
    if (isset($_POST['Email'])) {
        $Email =trim( $_POST['Email']);
    }

    if(empty($_POST['Email'])){
        $Mailfehler="Mail muss gesetzt sein";
        echo $Mailfehler."<br>";

    }
    if( filter_var($Email, FILTER_VALIDATE_EMAIL) ) {
        $Email =trim( $_POST['Email']);
        $Mailfehler = "";
        if(strpos($Email,"rcpt.at")||strpos($Email,"damnthespam.at")||strpos($Email,"wegwerfmail.de")||strpos($Email,"trashmail.")){
            $Mailfehler="Die eingegebene Mail ist falsch";
            echo $Mailfehler."<br>";
        }
    }






if ($Zustimmungfehler==""&&$Namefehler==""&&$Mailfehler=="") {
    echo "erfolgreiche Eingabe";
    $myfile = fopen("Speicher.txt", "a") ;

    fwrite($myfile,$_POST['vorname']."-");
    fwrite($myfile,$_POST['Email']."-");
    fwrite($myfile,$_POST['Sprache']."-");
    fwrite($myfile,"ON;\n");



}






}
}

