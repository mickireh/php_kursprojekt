<?php
if (!isset($_SESSION)) {
    ob_start();
    session_start();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="lib/css/main.css">
    <link rel="stylesheet" href="lib/css/form.css">
</head>
<body>
<div class="header">
    <h1>Home</h1>
    <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
   <!-- NAV -->
   <?php

        $page = basename(__FILE__); //Ermittelt welche Seite aktiv sein soll
        include 'lib/php/includes/nav_inc.php';
   ?>
</div>

<div class="row">
    <!-- #### index.php leftcolumn  #### -->
    <?php 
        include 'lib/php/classes/createContent.php';
        include 'lib/php/includes/datalogin_inc.php';   
 
        $erg = $mysqli->query('SELECT headline, subheadline,img, text FROM content_index');
        while(($zeile = $erg->fetch_assoc())) {
            echo createContent($zeile);
        }
        $mysqli->close();
    ?>
    <!-- <div class="leftcolumn">
        <div class="card">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2017</h5>
            <div class="fakeimg" style="height:200px;">Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco.</p>
        </div>
    </div> -->

    <!-- #### index.php leftcolumn  #### -->


    <div class="rightcolumn">
        <div class="card">
            <!-- LOGIN -->
            <?php
            include 'lib/php/includes/login_inc.php';
            ?>
        </div>
    </div>
</div>

<div class="footer">
    <!-- FOOTER -->
    <?php
    include 'lib/php/includes/footer_inc.php';
    ?>
</div>


</body>
</html>
<?php
    ob_flush();
?>
