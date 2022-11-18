<?php
function darstellen($gerichtid){
    //$gerichtid=$rd['gerichtid'];


    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql="SELECT bildname,name FROM gericht where id='$gerichtid'";
    $result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);
    //commit changes
    mysqli_commit($link);
    mysqli_close($link);
    return $result;
}

function check_feedback($bemerk,$Stern_bewert,$id){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql=" INSERT INTO bewertung(Bemmerkung,`Sterne-Bewertung`,Bewertungszeitpunkt,`Bewerber-id`) VALUES
    ('$bemerk','$Stern_bewert',CURRENT_TIMESTAMP ,'$id');";
   // $result=mysqli_query($link,$sql);
    mysqli_query($link, $sql);
   // $data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);

}
function bewertungen30(){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql="SELECT * FROM bewertung LIMIT 30";
    $result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);
    //commit changes
    mysqli_commit($link);
    mysqli_close($link);
    return $result;
}
function meinebewerbungen($id){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql="SELECT * FROM bewertung WHERE `Bewerber-id`='$id'";
    $result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);
    //commit changes
    mysqli_commit($link);
    mysqli_close($link);
    return $result;

}
function deletefeedback($id){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql=" DELETE FROM bewertung WHERE  id='$id';";
    $result=mysqli_query($link,$sql);
    // $data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);

}
function checkadmin($id){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql="SELECT admin FROM benutzer WHERE `id`='$id'";
    $result=mysqli_query($link,$sql);
    $data= mysqli_fetch_all($result,MYSQLI_ASSOC);
    //commit changes
    mysqli_commit($link);
    mysqli_close($link);
    return $data;


}
function hervorheben($id){
    $link= connectdb();
    mysqli_begin_transaction($link);

    $id =mysqli_real_escape_string($link,$id);
    $sql="UPDATE bewertung SET hervorgehoben=true where id='$id' ;";
    mysqli_query($link, $sql);
    //$result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);
}
function gethervorgehoben(){
    try {
        $link = connectdb();
        mysqli_begin_transaction($link);
        $sql = "SELECT * FROM bewertung WHERE hervorgehoben=true ORDER BY Bewertungszeitpunkt";
        $result = mysqli_query($link, $sql);

        //$data = mysqli_fetch_all($result, MYSQLI_BOTH);

        //mysqli_close($link);
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
        return $result;
    }
}
function delete($id){
    $link= connectdb();
    mysqli_begin_transaction($link);

    $id =mysqli_real_escape_string($link,$id);
    $sql="UPDATE bewertung SET hervorgehoben=false where id='$id' ;";
    mysqli_query($link, $sql);
    //$result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);
}
