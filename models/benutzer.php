<?php
/*echo '<form method="post" >';
echo'<label for="Email"> Ihre Email : </label>';
echo '<input id="Email" name="email" type="text", placeholder="Email">';
echo'<br>';
echo'<label for="Passwort"> Ihre Passwort : </label>';
echo '<input id="Passwort" name="passwort" type="text", placeholder="Passwort"> <br>';
echo'<input type="submit" value="Anmeldung" name="sub" style="color:steelblue">  ';
echo '</form>';*/
function getDaten(){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $sql="SELECT id,email,passwort,admin,anzahlanmeldungen FROM benutzer";
    $result=mysqli_query($link,$sql);
    $data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);
    return $data;

}
function getDaten_mitid($id){

    $link= connectdb();

    mysqli_begin_transaction($link);
    $sql="SELECT id,email,admin FROM benutzer WHERE id='$id'";
    $result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);
    //commit changes
    mysqli_commit($link);
    mysqli_close($link);
    return $result;

}
function inc_anzahlanmeldungen($email){
    $link= connectdb();
    mysqli_begin_transaction($link);

    $email =mysqli_real_escape_string($link,$email);
    $sql="UPDATE benutzer SET anzahlanmeldungen=anzahlanmeldungen+1 where email='$email' ;";
    mysqli_query($link, $sql);
    //$result=mysqli_query($link,$sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);

}
function setlastlogin($email){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $email =mysqli_real_escape_string($link,$email);
    $sql="UPDATE benutzer SET letzteanmeldung=CURRENT_TIMESTAMP where email='$email' ;";
    mysqli_query($link, $sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);
}
function setlastfault($email){
    $link= connectdb();
    mysqli_begin_transaction($link);
    $email =mysqli_real_escape_string($link,$email);
    $sql="UPDATE benutzer SET letzterfehler=CURRENT_TIMESTAMP where email='$email' ;";
    mysqli_query($link, $sql);
    //$data= mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_commit($link);
    mysqli_close($link);
}
function  inkrementierendb($id){
    $link= connectdb();
    mysqli_begin_transaction($link);

    $sql=" UPDATE benutzer SET admin=false;
UPDATE call inkrementieren('$id');";
    mysqli_query($link, $sql);

    mysqli_commit($link);
    mysqli_close($link);

}