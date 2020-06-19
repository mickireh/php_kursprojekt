<?php
    if(isset($_SESSION['login']) && $_SESSION['login'] === 'ok') {
        echo '<p>Sie sind als <strong>'.$_SESSION['username']. '</strong> eingeloggt.</p>';
        echo '<form action="/kurs/javascript/mysite/lib/php/logout.php" method="post"><input type="submit" name="logout" value="Ausloggen"></form>';
    } else {
        echo '<form action="/kurs/javascript/mysite/lib/php/login.php" method="POST"><ul class="form-style-1"><li><label>Benutzername <span class="required">*</span></label><input type="text" name="user" id="user" class="field"></li><li><label>Passwort <span class="required">*</span></label><input type="password" name="password" id="password" class="field"></li><li><input type="submit" name="login" value="Submit"></li></ul></form>';
    }
?>

