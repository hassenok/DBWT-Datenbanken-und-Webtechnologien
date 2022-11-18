





<?php
include 'bewerbung.php';
$data = array();
$data = prepareNewsletterData();
$dataFiltered = filter($data);
function prepareNewsletterData()
{

    $file = fopen('Speicher.txt', 'r');
    if (!$file) {
        die('Öffnen fehlgeschlagen');
    }

    $newsletteranmeldung = array();
    $counter = 0;
    $name = "";
    $email = "";
    $sprache = "";
    while (!feof($file)) {
        $line = fgets($file, 1024);
        $pieces = explode("-", $line);
        foreach ($pieces as $piece) {
            if ($counter == 0) {
                $name = $piece;
            } else if ($counter == 1) {
                $email = $piece;
            } else if ($counter == 2) {
                $sprache = $piece;
                $arrayelement = array("Name" => $name, "Email" => $email, "Sprache" => $sprache);
                array_push($newsletteranmeldung, $arrayelement);
            }

            $counter++;
        }

        $counter = 0;
    }


    fclose($file);
    return $newsletteranmeldung;
}


function sortArray($unsortedArray)
{
    if (!isset($_GET['sort'])) {
        $sort = "Name";
    } else {
        $sort = $_GET['sort'];
    }
    if ($sort == "email") {

        //Loop through and get the values of our specified key
        foreach ($unsortedArray as $k => $v) {
            $b[] = strtolower($v['Email']);
        }
    } else {

        //Loop through and get the values of our specified key
        foreach ($unsortedArray as $k => $v) {
            $b[] = strtolower($v['Name']);
        }
    }
    asort($b);
    foreach ($b as $k => $v) {
        $c[] = $unsortedArray[$k];
    }
    return $c;
}
function printNewsletter($anmeldungen){
$counter = 1;
echo "<table>";
echo "<tr>
    <th>Nummer</th>
    <th>Name</th>
    <th>Email</th>
    <th>Sprache</th>
    <th>Datenschutz</th>
  </tr>";
foreach ($anmeldungen as $anmeldung) {
    echo
        "<tr>" .
        "<td>" . htmlspecialchars($counter) . "</td>" .
        "<td>" .htmlspecialchars( $anmeldung['Name'] ). "</td>" .
        "<td>" . htmlspecialchars($anmeldung['Email'] ). "</td>" .
        "<td>" . htmlspecialchars($anmeldung['Sprache']) . "</td>" .
        "<td>&check;</td>" .
        "</tr>";
    $counter++;
}}
echo "</table>";
function filter($newsletteranmeldungen)
{

    $anmeldungenArray = [];
    if (!empty($_GET['search_text'])) {
        $searchTerm = $_GET['search_text'];
        foreach ($newsletteranmeldungen as $anmeldungen) {
            if (stripos($anmeldungen['Name'], $searchTerm) !== false) {
                $anmeldungenArray[] = $anmeldungen;
            }
        }
    }
    return $anmeldungenArray;
}
if(empty($_GET['search_text'])){
    printNewsletter(sortArray(prepareNewsletterData()));
}else{
    printNewsletter($dataFiltered);
}