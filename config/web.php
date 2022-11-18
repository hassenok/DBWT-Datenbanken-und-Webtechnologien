<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */
session_start();
return array(
    '/'             => 'HomeController@index',
    '/demo'         => 'DemoController@demo',
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/kategorie' =>'ExampleController@dbconnect1',
    '/Aufgabe_c'=>'ExampleController@dbconnect2',
    '/layout' =>'ExampleController@layout',
    '/tabelle'=>'ExampleController@mainlayout_tables',
    '/anmeldung'=>'ExampleController@anmelden',
    '/anmeldung_verifizieren'=>'ExampleController@check',
    '/abmeldung'=>'ExampleController@abmelden',
    '/test' => 'HomeController@test',
    
    '/bewertung'=>'ExampleController@bewerten',
    '/fillthebewertung'=>'ExampleController@fill',
    
    
    '/bewertungen'=>'ExampleController@bewertungen',
    '/meinebewertungen'=>'ExampleController@meinebew',
    '/delete'=>'ExampleController@loeschen',


    // Erstes Beispiel:
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4' => 'ExampleController@m4_6a_queryparameter'

);