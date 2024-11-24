<?php

function incluirTemplade( $nombre ) {
    include "includes/templades/${nombre}.php";
}


function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}