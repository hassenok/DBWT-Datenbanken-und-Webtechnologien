<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    try {
        $link = connectdb();
        mysqli_begin_transaction($link);
        $sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        mysqli_commit($link);
        mysqli_close($link);
        return $data;
    }

}
function db_gericht_select_all1() {
    try {
        $link = connectdb();
        mysqli_begin_transaction($link);
        $sql = "SELECT id, name, beschreibung,preis_intern FROM gericht ORDER BY name DESC ";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        mysqli_commit($link);
        mysqli_close($link);
        return $data;
    }

}
function db_gericht_select_bilder() {

        $link= connectdb();
        mysqli_begin_transaction($link);
        $sql="SELECT name,bildname,id FROM gericht";
        $result=mysqli_query($link,$sql);
        //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);
        //commit changes
        mysqli_commit($link);
        mysqli_close($link);
        return $result;

    }