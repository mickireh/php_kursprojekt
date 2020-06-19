<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>M.Hirsch - Song List</title>
    <meta name="description" content="Song List">
    <link rel="shortcut icon" type="image/x-icon" href="./public/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./public/style/global.css">
    <link rel="stylesheet" href="./public/style/columns.css">
    <link rel="stylesheet" href="./public/style/style.css">
    <link rel="stylesheet" href="./public/style/lightbox.min.css">
    <script src="./public/js/ie/html5shiv.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="./public/js/jquery-3.4.1.min.js"><\/script>');
    </script>
    <script src="./public/js/lightbox.min.js"></script>
    <script src="./public/js/script.js"></script>
    <script <?= ($page === 'songlist') ? 'src="./public/js/scriptlist.js"' : ''?>></script>
    <script <?= ($page === 'bosse') ? 'src="./public/js/scriptbosse.js"' : ''?>></script>

<?php if($page === 'answer') : ?>
    <!--  Weiterleitung funzt, Zeit nicht. wird sofort weitergeleitet und browser unterbricht diese weiterleitung mit meldung-->
    <!-- <meta http-equiv="refresh" content="5; url=?page=bosse" /> -->
<?php endif; ?>

</head>
<body>
