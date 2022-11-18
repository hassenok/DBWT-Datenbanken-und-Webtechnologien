<?php
/*
 * Praktikum DBWT. Autoren:
 * Ali , Ayadi , 3276402
 * Hassen , Trabelsi , 3286633
 */
/*$meal=[




    ["Beschreibung"=>"Basmatireis mit Pommes ",
    "interner_preis"=>"2.50€",
    "externer_preis"=>"5.80€"],

    ["Beschreibung"=>"Salat ",
        "interner_preis"=>"2.50€",
        "externer_preis"=>"5.80€"],*/
    $meals = [
        ['description'=>'Rindfleisch mit Bambus,Kaiserschoten Und rotem Paprika,dazu mit Nudeln',
            'price_intern'=>'3.50€',
            'price_extern'=>'6.20€',
            'bilddatei'=>'img/photo1.jpg'],
        ['description'=>'Spinatrisotto mit kleinen Samosateigecken Und gemischter Salat',
            'price_intern'=>'2.90€',
            'price_extern'=>'5.30€',
            'bilddatei'=>'img/sommerlicher.jpg'],
        [
            'description' => 'Döner Kebab mit scharf',
            'price_intern' => "2,10" ,
            'price_extern' => "2,60" ,
            'bilddatei' => 'img/doner.jpg'
        ],
        [
            'description' => 'Lablebi',
            'price_intern' => "2,10",
            'price_extern' => "2,60",
            'bilddatei' => 'img/lablebi.jpg'
        ]

    ];
    $view=0;

    ?>