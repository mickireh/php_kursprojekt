<?php
$mysqli = new mysqli('localhost','root','','mysite');
if($mysqli->connect_error) {
    echo 'Verbindungsfehler: ' . $mysqli->connect_error . '<br>';
    die();
}
if(!$mysqli->set_charset('utf8')) {
    echo 'Fehler beim laden von UTF-8';
}
?>