<?php
if(!isset($_SESSION)) {
    ob_start();
    session_start();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>KONTAKT</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../lib/css/main.css">
    <link rel="stylesheet" href="../lib/css/form.css">
</head>
<body>
<div class="header">
    <h1>KONTAKT</h1>
    <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
   <!-- NAV -->
   <?php
        $page = basename(__FILE__);
        include '../lib/php/includes/nav_inc.php';
   ?>
</div>

<div class="row">
    <div class="leftcolumn">
        <div class="card">
            <h2>KONTAKTFORMULAR</h2>
            <?php
                include '../lib/php/includes/contact_form_inc.php';
            ?>
        </div>

    </div>
    <div class="rightcolumn">
        <div class="card">
            <!-- LOGIN -->
            <?php
            include '../lib/php/includes/login_inc.php';
            ?>
        </div>
    </div>
</div>

<div class="footer">
    <!-- FOOTER -->
    <?php
    include '../lib/php/includes/footer_inc.php';
    ?>
</div>


</body>
</html>
