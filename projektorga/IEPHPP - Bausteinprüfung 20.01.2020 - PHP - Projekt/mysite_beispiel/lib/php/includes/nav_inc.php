<?php   
    echo "<script>console.log('".htmlspecialchars($_SERVER['PHP_SELF'])."')</script>";
    echo "<script>console.log('".basename($_SERVER['PHP_SELF'])."')</script>";
    echo "<script>console.log('".dirname($_SERVER['PHP_SELF'])."')</script>";
    echo "<script>console.log('".$_SERVER['SCRIPT_NAME']."')</script>";    
    /* Mit den PHP Pfadbefehlen kann man für die folgenden Navigation die Pfade automatisiert bestimmen. */
    
?>

<a href="/kurs/javascript/mysite/index.php" class="<?php echo ($page === 'index.php') ? 'active' : '' ?>">HOME</a>
<a href="/kurs/javascript/mysite/pages/shop.php" class="<?php echo ($page === 'shop.php') ? 'active' : '' ?>">SHOP</a>
<a href="/kurs/javascript/mysite/pages/contact.php" class="<?php echo ($page === 'contact.php') ? 'active' : '' ?>">KONTAKT</a>
<a href="/kurs/javascript/mysite/pages/imp.php" class="<?php echo ($page === 'imp.php') ? 'active' : '' ?>">IMPRESSUM</a>
<?php
if (isset($_SESSION['login']) && $_SESSION['login'] === 'ok') {
    ?>
<a href="/kurs/javascript/mysite/pages/backend.php" class="<?php echo ($page === 'backend.php') ? 'active' : '' ?>" style="float:right;">BACKEND</a>

<?php
}

/*    
     if($page === 'index.php') {
        $path = dirname($_SERVER['PHP_SELF']) . '/pages/';
    } else {
        $path = dirname($_SERVER['PHP_SELF']);
    }

    <a href="<?php echo $path ?>index.php" class="<?php echo ($page === 'index.php') ? 'active' : '' ?>">HOME</a>
<a href="<?php echo $path ?>shop.php" class="<?php echo ($page === 'shop.php') ? 'active' : '' ?>">SHOP</a>
<a href="<?php echo $path ?>contact.php" class="<?php echo ($page === 'contact.php') ? 'active' : '' ?>">KONTAKT</a>
<a href="<?php echo $path ?>imp.php" class="<?php echo ($page === 'imp.php') ? 'active' : '' ?>">IMPRESSUM</a>
<a href="<?php echo $path ?>login.php" class="<?php echo ($page === 'login.php') ? 'active' : '' ?>" style="float:right;">LOGIN</a> */
    
?>

