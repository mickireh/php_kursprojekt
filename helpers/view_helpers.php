<?php declare(strict_types=1);


function view_escape(string $string) : string
{
    if ($string === '') {
        return '';
    }

    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}


// e() ist nur ein alias für view_escape()
function e(string $string) : string
{
    return view_escape($string);
}

function setActive(string $page, string $page_active) 
{
    if ($page === $page_active || $page === 'songlist' && $page_active === 'music' || $page === 'add' && $page_active === 'music') {
        return "active";
    } else {
        return '';
    }
}
