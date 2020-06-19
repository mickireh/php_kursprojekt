<?php
    /* Auf dem Server und im Client wird die Session beendet */
    if(isset($_POST['logout'])) {
        session_start();
        /* username und login im globalen Serverarray werden überschrieben  */
        $_SESSION = array();
        if(isset($_COOKIE[session_name()])) {
            /* Die Information aus dem Serverarray $_Session wird im Client immer in einem Cookie gespeichert. Darum wird hier der Cookie zurückgesetzt. */
            setcookie(session_name());
        }
        /* Beendet alle Session bestandteile */
        // session_destroy();
        session_unset();
        header('Location: /kurs/javascript/mysite/index.php');
    }
?>