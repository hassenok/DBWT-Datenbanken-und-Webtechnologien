<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/selectieren.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/benutzer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/hash.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/Bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichtar.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertungar.php');
use \Illuminate\Database\Capsule\Manager as DB;





class ExampleController
{


    public function m4_6a_queryparameter(RequestData $rd) {



        return view('example.m4_6a_queryparameter', [
            'request'=>$rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }
    public function layout() {
        $page=$_GET['no'] ?? 1;
         if($page==1){
             return view('m4_6d_page_1');
         }

         else if ($page==2){
             return view('m4_6d_page_2');

        }
    }


    public function dbconnect1() {
        //$data = db_gericht_select_all();
        // Frage Daten aus kategorie ab:
        $data = db_kategorie_select_all();
        return view('example.m4_6b_kategorie', ['data' => $data]);
    }
    public function dbconnect2() {
        $data = db_gericht_select_all1();

        // Frage Daten aus kategorie ab:
       // $data = db_kategorie_select_all();

        return view('example.m4_6c_gerichte', ['data' => $data]);
    }
    public function mainlayout_tables() {
        $data1=selectfrom1();
        $data2=selectfrom2();
        $data3=selectfrom3();
        return view('Tabelle',['data1' => $data1,'data2' => $data2,'data3' => $data3]);
    }

public function anmelden(RequestData $request){
        return view('anmeldung',['fehler'=>'']);
}

    /** Route /login_check */
    public function check(RequestData $rd) {
        $testadmin=false;
        $datax=db_gericht_select_bilder();
        $dataxx=gethervorgehoben();
        $benutzer=getDaten();
        //eingegeben Bentuzer aus Request
        $data=$rd->query;
        //richtig ?
        global $success;
        $success=false;
        // for-Schleife zur Überprüfung von alle  bentzern
        for($i=0;$i<count($benutzer);$i++){
            if($data['email']== $benutzer[$i]['email']){
                if(calculatehash($data['passwort'])== $benutzer[$i]['passwort']){
                   // $name=str()$data['email'];
                    $success=true;
                    //anmeldungenanzahl inkrementieren
                    //inc_anzahlanmeldungen($data['email']);
                    inkrementierendb($benutzer[$i]['id']);
                    //$_SESSION['id']=$_GET['email'];


                    //speichere Datum der Anmeldung
                    setlastlogin($data['email']);
                    $logger=logger();
                    $logger->info('anmelden');


                    if(checkadmin($benutzer[$i]['id'])){
                        $testadmin=true;
                    }
                    //$_SESSION['email']=$benutzer['email'];
                    return view('home',['name'=>$data['email'],'dataxx'=>$dataxx,'testadmin'=>$testadmin,'test'=>true,'data'=>$datax,'id'=>$benutzer[$i]['id']]);


                }
            }
        }
        if(!$success){

            setlastfault($data['email']);
            $logger=logger();
            $logger->warning('fehler bei der Anmeldung');


            return view('anmeldung',['data'=>$datax,'fehler'=>'Die eingegebene Zugangsdaten sind falsch ! Versuchen Sie es nochmal ...']);

        }


    }
    public function abmelden(){
        $datax=db_gericht_select_bilder();
        $dataxx=gethervorgehoben();
        $logger=logger();
        $logger->info('abmelden');
        return view('home',['name'=>'','testadmin'=>false,'dataxx'=>$dataxx,'data'=>$datax,'test'=>false]);
    }
    public function bewerten(RequestData $rd){
        $gerichtid=$_GET['gerichtid'];

        $gericht=mysqli_fetch_assoc(darstellen($gerichtid));
        $gericht1=gerichtar::find($gerichtid);

        $test1=false;

           return view ('bewertung',['gerichtname'=>$gericht1->name,'bildname'=>$gericht['bildname'],'test1'=>$test1]);

    }

    public function fill(RequestData $rd){
        $testadmin=false;
        $datax=db_gericht_select_bilder();
        $dataxx=gethervorgehoben();
        $var1=$_GET['bemerkung'] ;
        $var2=$_GET['sterne'];
        if(isset($var1 )){
            if( isset($var2)){
                check_feedback($var1,$var2,$_GET['id']);

                $benutzer=mysqli_fetch_assoc(getDaten_mitid($_GET['id']));
                //admin überprüfen
                if(checkadmin($benutzer['id'])){
                    $testadmin=true;
                }

                return view('home',['name'=>$benutzer['email'],'testadmin'=>$testadmin,'dataxx'=>$dataxx,'data'=>$datax,'test'=>true,'id'=>$benutzer['id']]);
            }
        }

    }


    public function bewertungen(){
        $test1=true;
        $testadmin=false;

        $bewertungen=bewertungen30();
        if(isset($_GET['id'])){
            if(checkadmin($_GET['id'])){
                $testadmin=true;
                if(isset($_GET['bewertid'])){

                //hervorheben($_GET['bewertid']);
                $bewertung1=bewertungar::find($_GET['bewertid']);
                $bewertung1->hervorgehoben=true;
                $bewertung1->save();}
            }
        }
        return view('bewertung',['bewertungen'=>$bewertungen,'test1'=>$test1 ,'testadmin'=>$testadmin,'privat'=>false]);
    }
    public function meinebew(){
        $testadmin=false;
        if(isset($_GET['bewertid'])){

       // $zulöschen_bew_id=$_GET['bewertid'];
        //deletefeedback($zulöschen_bew_id);
        //löschen anders
            $bewertung1=bewertungar::destroy($_GET['bewertid']);

            //$bewertung1->save();


        }
        if(checkadmin($_GET['id'])){
            $testadmin=true;
        }
        $benutzerid=$_GET['id'];
        $bew=meinebewerbungen($benutzerid);
        return view('bewertung',['bewertungen'=>$bew,'testadmin'=>$testadmin,'test1'=>true,'privat'=>true]);
    }
    public function loeschen(){
        delete($_GET['bewertid']);
        return view ('delete',['bewertid'=>$_GET['bewertid']]);
    }
}
