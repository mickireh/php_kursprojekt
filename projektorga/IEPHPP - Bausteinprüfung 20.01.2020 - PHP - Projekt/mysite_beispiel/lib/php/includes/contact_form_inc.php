<?php
    /* Beim ersten laden, sind alle values leer */
    $vorname = '';
    $nachname = '';
    $email = '';
    $gender = '';
    $subject = '';
    $message = '';
    /* Wird die Seite über submit an sich selbst gesendet, prüfen ob Felder einen Inhalt (value) haben... */
    if(isset($_GET['send'])) {
        /* Inhalt (value) vorhanden, Der Wert wird in Variable gespeichert.
        Dadurch wird die Auswahl des Benutzers beim erneuten laden vorbelegt (wieder angezeigt) */
        $vorname = (isset($_GET['vorname']) ? $_GET['vorname'] : '');
        $nachname = (isset($_GET['nachname']) ? $_GET['nachname'] : '');
        $email = (isset($_GET['email']) ? $_GET['email'] : '');
        $gender = (isset($_GET['gender']) ? $_GET['gender'] : '');
        $subject = (isset($_GET['subject']) ? $_GET['subject'] : '');
        $message = (isset($_GET['message']) ? $_GET['message'] : '');        
    }
    /* Solange nicht alle Felder ausgefüllt wurden, wird durch das else das Formular angezeigt.
    Erst wenn alle Felder nicht mehr leer sind zeigen wir den Bestätigungsbereich mit Formular hidden an. */
    if($vorname != '' && $nachname != '' && $email != '' && $gender != '' && $subject != '' && $message != '') {
        $query = '';
        foreach($_GET as $key => $value) {
            $query .= '&'.$key.'='.$value;
        }
        /* &vorname=Max&nachname=Mustermann... */
        $query = preg_replace('/^&/','?',$query);
        /* ?vorname=Max&nachname=Mustermann... */

        /* $anrede ist leer, keine Anrede bei Geschlecht x.  */
        $anrede = '';
        /* Muss der Benutzer mit Herr oder Frau angesprochen werden... */
        if($gender == 'female') {
            $anrede = 'Frau';
        } else if($gender == 'male') {
            $anrede = 'Herr';
        }

        echo '<p>Hallo ' . $anrede . ' ' . $vorname .', ' . $nachname.' Ihre Anfrage bezüglich ' . $subject . ', wird von uns bearbeitet. Durch das klicken auf Absenden bestätigen Sie ein letzes Mal Ihre Eingaben und leiten den weiteren Bearbeitungsprozeß ein.</p>';
        echo '<form action="../lib/php/feedback.php" method="post">';
        echo '<input type="hidden" name="data" value="'.$query.'">';
        echo '<input type="submit" name="sendData" value="Absenden">';
        echo '</form>';
    } else {
        echo '<form action="'. $_SERVER['PHP_SELF'] . '" method="get">';
        echo '<ul class="form-style-1">';
        echo '<li>';
        echo '<label>Vorname <span class="required">*</span></label>';
        /* $vorname ist beim ersten laden der Seite noch leer, value wird leer angezeigt.
        Wurde das Formular über submit gesendet und das Feld hat einen Inhalt (Benutzereingabe)
        wird diese wieder im Feld voreingetragen */
        echo '<input type="text" name="vorname" id="vorname" class="field" value="'.$vorname.'"/>';
        /* Wurde das Formular gesendet und ist das Feld noch leer -> Fehlermeldung anzeigen */
        echo ((isset($_GET['send']) && $vorname == '')) ? '<label class="required">Vorname darf nicht leer sein</label>' : '';
        echo '</li>';
        echo '<li>';
        echo '<label>Nachname <span class="required">*</span></label>';
        echo '<input type="text" name="nachname" id="nachname" class="field" value="'.$nachname.'"/>';
        echo ((isset($_GET['send']) && $nachname == '')) ? '<label class="required">Nachname darf nicht leer sein</label>' : '';
        echo '</li>';
        echo '<li>';
        echo '<label>Email <span class="required">*</span></label>';
        echo '<input type="text" name="email" class="field-long" value="'.$email.'"/>';
        echo ((isset($_GET['send']) && $email == '')) ? '<label class="required">E-Mail darf nicht leer sein</label>' : '';
        echo '</li>';
        echo '<li>';
        echo '<h4>Geschlecht <span class="required">*</span></h4>';
        echo '<label for="female"><input type="radio" name="gender" value="female" '. (($gender == 'female') ? 'checked="checked"' : '') . '>Female</label>';
        echo '<label for="male"><input type="radio" name="gender" value="male"' .( ($gender == 'male') ? 'checked="checked"' : '') . '>Male </label>';
        echo '<label for="x"><input type="radio" name="gender" value="x"' . (($gender == 'x') ? 'checked="checked"' : '' ). '>X </label>';
        echo ((isset($_GET['send']) && $gender == '')) ? '<label class="required">Geschlecht darf nicht leer sein</label>' : '';
        echo '</li>';
        echo '<li>';
        echo '<label>Subject <span class="required">*</span></label>';
        echo '<select name="subject" class="field-select">';
        echo '<option value="" '. (($subject == '') ? 'selected="selected"' : '' ).'>--Bitte wählen--</option>';
        echo '<option value="Advertise" '. (($subject == 'Advertise') ? 'selected="selected"' : '' ).'>Advertise</option>';
        echo '<option value="Partnership"' . (($subject == 'Partnership') ? 'selected="selected"' : '' ).'>Partnership</option>';
        echo '<option value="General Question" '. (($subject == 'General Question') ? 'selected="selected"' : '' ).'>General</option>';
        echo '</select>';
        echo ((isset($_GET['send']) && $subject == '')) ? '<label class="required">Bitte Grund des Kontakts wählen</label>' : '';
        echo '</li>';
        echo '<li>';
        echo '<label>Your Message <span class="required">*</span></label>';
        echo '<textarea name="message" id="message" class="field-long field-textarea">'.$message.'</textarea>';
        echo ((isset($_GET['send']) && $message == '')) ? '<label class="required">Bitte geben Sie eine Nachricht ein</label>' : '';
        echo '</li>';
        echo '<li>';
        echo '<input type="submit" value="Submit" name="send" />';
        echo '</li>';
        echo '</ul>';
        echo '</form>';
    }
    
?>
