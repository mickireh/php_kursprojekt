<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>FEEDBACK</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<div class="header">
    <h1>My Website</h1>
    <p>Resize the browser window to see the effect.</p>
</div>



<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <?php
                if(isset($_POST['sendData'])) {
                    /* ?vorname=Max&nachname=Mustermann... */
                    $temp = substr($_POST['data'],1);
                    /* vorname=Max&nachname=Mustermann... */
                    $temp = explode('&',$temp);
                    /* ['vorname=Max','nachame=Mustermann' ...] */
                    $temp = array_map(function($word) { return ucfirst($word); }, $temp);
                    /* ['Vorname=Max','Nachame=Mustermann' ...] */
                    array_pop($temp); //=> input[name=sendData] wird entfernt 'Name=sendData'
                    $data = array();
                    $filedata = '';
                    // $temp => ['Vorname=Max','Nachname=Mustermann' ... ]
                    foreach($temp as $value) {
                        $s = explode('=', $value); // 'Vorname=Max' => ['Vorname','Max']
                        $data[$s[0]] = $s[1]; //=> array('Vorname' => 'Max');
                        /* $data['Vorname'] = 'Max'
                        $data['Nachname'] = 'Mustermann'*/
                        $filedata .=  $s[0] . ':' . $s[1] . "\r\n";
                    }
                    /* 
                    $data = array('Vorname' => 'Max','Nachname' => 'Mustermann'...);
                    */
                    $dirname = '../data/';
                    /* Dateiname Max_Mustermann_Advertise  Muster: Vorname_Nachname_Subject */
                    $filename = $data['Vorname'] . '_' . $data['Nachname'] . '_' . $data['Subject'] . '.txt';
                    /* Prüfen ob die Datei bereits vorhanden ist... */
                    while(file_exists($dirname .$filename)) {
                        /* ...wenn vorhanden vor den Dateinamen ein 'kopie_' einfügen */
                         $filename = 'kopie_' . $filename;
                    }
                    /* Wenn die Datei nicht geschrieben werden kann... */
                    if(!file_put_contents($dirname .$filename, $filedata)) {
                        /* ...Fehlermeldung anzeigen */
                        echo '<p><b>Fehler beim schreiben der Daten</b></p>';   
                    } else {
                        /* Kein Fehler Information an Benutzer und Weiterleitung nach 5 Sekunden */
                        echo '<p>Vielen Dank wir werden uns schnellst möglich um Ihr anliegen kümmern.<br>Sie werden in 5 Sekunden zur Startseite weitergeleitet.</p>';
                        /* TODO: E-Mail an Admin versenden */
                        //header('Refresh:5; url=/kurs/javascript/mysite/index.php');
                    }
                }
            ?>
        </div>

    </div>
    <div class="rightcolumn">
        <div class="card">
            <h2>About Me</h2>
            <div class="fakeimg" style="height:100px;">Image</div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>
        <div class="card">
            <h3>Popular Post</h3>
            <div class="fakeimg"><p>Image</p></div>
            <div class="fakeimg"><p>Image</p></div>
            <div class="fakeimg"><p>Image</p></div>
        </div>
    </div>
</div>
</body>
</html>
