<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/Bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichtar.php');
use \Illuminate\Database\Capsule\Manager as DB;


class HomeController
{

    public function index(RequestData $request) {
        $datax=db_gericht_select_bilder();
        $dataxx=gethervorgehoben();
        $logger=logger();
        $logger->info('Hauptseite ist aufgerufen');
        return view('home', ['rd' => $request,'data'=>$datax ,'dataxx'=>$dataxx,'testadmin'=>false,'test'=>false]);
    }

    public function debug(RequestData $request) {
        return view('debug');
    }
    public function test() {


        //$data=db_gericht_select_bilder();
        //return view('gerichtemitbilder', ['rd' => $request,'data'=>$data ,'test'=>false]);
        $gericht=gerichtar::find(5);
        $gericht->preis_intern=2.5;
        $gericht->save();
        echo'Jetzt';
    }
}
