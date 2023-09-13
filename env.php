<?php

$file = ".env";
$env = [];

if (file_exists($file)) {
    $GLOBALS['env'] = parse_ini_file($file); // recupera le variabili e i valori dal file .env
}

function host() {
    return $GLOBALS['env']['HOST'];
}

function user() {
    return $GLOBALS['env']['USER'];
}

function password() {
    return $GLOBALS['env']['PASSWORD'];
}

?>