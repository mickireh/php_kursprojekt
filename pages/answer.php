<?php
// header( "refresh:5;url=?page=songlist" );
// nein

// POST - REDIRECT - GET
// https://www.youtube.com/watch?v=bIkqNHyj25w
// https://de.wikipedia.org/wiki/Post/Redirect/Get
// Wenn das Formular durch den Bentuzer mittels POST abgeschickt wird, soll die antwort aber von einem GET sein. 
// So wird verhindert, dass der Benutzer beim evtl Neuladen der Antwortseite den POST noch einmal sendet. (2x mal Daten abschicken, 2x mal einkaufen; no bueno) 
// Das Formular wird, nachdem die daten verarbeitet worden sind, nochmals an sich selbst geschickt mit 302 um dann als GET weiterzuletien (mein verständnis des unten stehenden codes). 
// anders: browser bekommt nach POST antwort mit header, der redirected. antwort ist neue seite als GET. 
// daten des originalen POST müssen - wenn sie auf der antwortseite angezeigt werden sollen - in einer session variable gespeichert werden. 

// oder status 303 setzen, aber wo? nein.
// und bei der login funzt es auch mit direktem redirect. weil es die gleiche seite ist? ja

// wenn nicht session dann session_start();

$errors = [];
$redirect_to = "?page=contact";

if (request_is("POST")) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty(request('nachname'))) {
        $errors['nachname'] = 1;
        unset($_SESSION['formname']);
        $_SESSION['errorname'] = '<p class=error>Bitte geben Sie Ihren Namen ein.</p>';
    } else {
        $_SESSION['formname'] = request('nachname');
        unset($_SESSION['errorname']);
    }

    if (empty(request('vorname'))) {
        $errors['vorname'] = 1;
        unset($_SESSION['formvorname']);
        $_SESSION['errorvorname'] = '<p class=error>Bitte geben Sie Ihren Vornamen ein.</p>';
    } else {
        $_SESSION['formvorname'] = request('vorname');
        unset($_SESSION['errorvorname']);
    }

    if (empty(request('email'))) {
        $errors['email'] = 1;
        unset($_SESSION['formemail']);
        $_SESSION['erroremail'] = '<p class=error>Bitte geben Sie eine Email ein.</p>';
    } else {
        if (! filter_var(request('email'), FILTER_VALIDATE_EMAIL) ) {
            $errors['email'] = 1;
            $_SESSION['formemail'] = request('email');
            $_SESSION['erroremail'] = '<p class=error>Bitte geben Sie eine valide Email ein.</p>';
        } else {
            $_SESSION['formemail'] = request('email');
            unset($_SESSION['erroremail']);
        }
    }


    if (empty(request('message'))) {
        $errors['message'] = 1;
        $_SESSION['errormessage'] = '<p class=error>Bitte geben Sie eine Nachricht ein.</p>';
    } else {
        unset($_SESSION['errormessage']);
    }

    if (!$errors) {

        // $_SESSION['formname'] = request('nachname');
        // $_SESSION['formvorname'] = request('vorname');
        unset($_SESSION['errorname']);
        unset($_SESSION['errorvorname']);
        unset($_SESSION['erroremail']);
        unset($_SESSION['errormessage']);

        // $nachname = htmlspecialchars(request('nachname'));
        // $vorname = htmlspecialchars(request('vorname'));
        $nachname = db_escape($db, request('nachname'));
        $vorname = db_escape($db, request('vorname'));
        $email = db_escape($db, request('email'));
        $message = db_escape($db, request('message'));

        $topic = request('auswahl');

        db_insert($db, 'contacts', [
            'lastname' => $nachname,
            'firstname' => $vorname,
            'email' => $email,
            'message' => $message,
            'topic' => $topic
        ]);

        redirect("?page=answer");
        exit;

    } else {
        redirect("?page=contact");
        // redirect("?page=contact&vorname=".request('vorname')."&nachname=".request('nachname')."&email=".request('email')."&message=".$errors['message']);
    }
}

?>
<main>
<script type="text/javascript">
   setTimeout(function() { 
       window.location.href = "?page=home";
   },5000);
</script>

<p>Hallo <?= isset($_SESSION['formvorname']) ? htmlspecialchars($_SESSION['formvorname']) : '' ?> <?= isset($_SESSION['formname']) ? htmlspecialchars($_SESSION['formname']) : '' ?></p>
<p>Danke. Sie werden in 5 Sekunden umgeleitet. </p>
<p>Ich bin ein HTTP GET request. Sollte ich aktualisiert werden, werden die Daten nicht nochmal gesendet!</p>

</main>

