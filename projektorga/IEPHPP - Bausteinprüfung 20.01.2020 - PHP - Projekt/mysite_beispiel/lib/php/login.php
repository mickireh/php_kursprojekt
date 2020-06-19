<?php
    /*Hier gibt es nur einen User, bei mehreren Einträgen muss das ganze angepasst werden  */
   if ($_POST['login']) {
       include 'includes/datalogin_inc.php';

       $erg = $mysqli->query('SELECT username, password FROM user');
       $zeile = $erg->fetch_array();
       $mysqli->close();      

       if ($_POST['user'] === $zeile['username'] && $_POST['password'] === $zeile['password']) {
           session_start();
           $_SESSION['username'] = $zeile['username'];
           $_SESSION['login'] = 'ok';
           /* TODO: Sicherung einbauen mit Token bzw. Datum */
           header('Location: /kurs/javascript/mysite/index.php');
       }
   }
