<?php declare(strict_types=1);


function session(string $key, $value = null)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Read
    if (func_num_args() === 1) {
        return $_SESSION[$key] ?? null;
    }

    // Delete
    if ($value === null) {
        unset($_SESSION[$key]);
        return true;
    }

    // Create
    $_SESSION[$key] = $value;
    return true;
}


function login($user)
{
    session('user', $user);
}


function logout()
{
    session('user', null);
}


function auth_user()
{
    return session('user');
}


function auth_id($key = 'id')
{
    $user = session('user');

    if (is_int($user)) {
        return $user;
    }

    return $user[$key];
}
