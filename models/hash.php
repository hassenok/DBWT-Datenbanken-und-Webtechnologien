<?php
// diese function berechnet die Hashing von den eingegebenen Passwort
function calculatehash($pass){
    return sha1('emensa'.$pass);
}