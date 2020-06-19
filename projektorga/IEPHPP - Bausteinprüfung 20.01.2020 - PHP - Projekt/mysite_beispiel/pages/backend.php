<?php
if(!isset($_SESSION)) {
    ob_start();
    session_start();
}
if (isset($_SESSION['login']) && $_SESSION['login'] === 'ok') {
    ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>BACKEND</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../lib/css/main.css">
    <link rel="stylesheet" href="../lib/css/form.css">
</head>
<body>
<div class="header">
    <h1>BACKEND</h1>
    <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
   <!-- NAV -->
   <?php
        $page = basename(__FILE__);
        include '../lib/php/includes/nav_inc.php'; ?>
</div>

<div class="row">    
    <div class="leftcolumn">
            <!-- 
            Einträge der Datenbank anzeigen und editierbar machen. 
            
            -->
    </div>
    <div class="rightcolumn">
        <div class="card">
			<!-- LOGIN -->
            <?php
            include '../lib/php/includes/login_inc.php'; ?>
        </div>
    </div>
</div>

<div class="footer">
    <!-- FOOTER -->
    <?php
    include '../lib/php/includes/footer_inc.php'; ?>
</div>


</body>
</html>
<?php
} else {
    header('Location: /kurs/javascript/mysite/index.php');
}
?>

