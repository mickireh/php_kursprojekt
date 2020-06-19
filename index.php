<?php declare(strict_types=1);

// Globals: $db, $pages, $page, $file

require_once './bootstrap.php';

$page = $_GET['page'] ?? 'home';

include './parts/head.php';
include './parts/nav.php';

$file = './pages/' . $page . '.php';

// Do we really want to double check the file AND the array?
// Is the file enough? Depends on possible uploads.
if (!in_array($page, $pages) || !file_exists($file)) {
    http_response_code(404);
    echo "<h1>Page not Found</h1>";

} else {
    include $file;
}

include './parts/foot.php';