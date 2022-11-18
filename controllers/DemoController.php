<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/selectieren.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichtar.php');
use \Illuminate\Database\Capsule\Manager as DB;




class DemoController
{

    protected  function dbconnect() {
        $data = db_gericht_select_all();
        // Frage Daten aus kategorie ab:
         $data = db_kategorie_select_all();
        return view('demo.dbdata', ['data' => $data]);
    }


    public function demo(RequestData $rd) {
        $vars = [
            'bgcolor' => $rd->query['bgcolor'] ?? 'ffffff',
            'name' => $rd->query['name'] ?? 'Dich',
            'rd' => $rd
        ];
        return view('demo.demo', $vars);
    }
    public function bewert (){

    }

}
