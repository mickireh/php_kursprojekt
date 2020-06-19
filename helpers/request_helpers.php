<?php declare(strict_types=1);


function request_method() : string
{
    return $_SERVER['REQUEST_METHOD'];
}


function request_is(string $method) : bool
{
    // Die lange Variante
    // if ($_SERVER['REQUEST_METHOD'] === $method) {
    //     return true;

    // } else {
    //     return false;
    // }

    // Mit Ternäroperator
    // return ($_SERVER['REQUEST_METHOD'] === $method)
    //     ? true
    //     : false;
    
    // Die kurze (idiomatische) Variante
    return strtoupper(request_method()) === strtoupper($method);
}

// request()                 // ALLES aus $_GET und $_POST
// request(string $key)      // Ein bestimmter Wert aus $_GET oder $_POST
// request(array [$keys])    // Mehrere Werte aus $_GET oder $_POST

function request_get_value(string $key)
{
    return $_POST[$key] ?? $_GET[$key] ?? null;
}


function request($keys = null)
{
    if (is_null($keys)) {
        return array_merge($_GET, $_POST);
    
    }
    
    if (is_string($keys)) {
        return request_get_value($keys);

        // Oder ohne die Hilfsfunktion request_get_value:
        //   return array_merge($_GET, $_POST)[$key] ?? null;
        // oder
        //   return $_POST[$key] ?? $_GET[$key] ?? null;
    }

    $result = [];

    // foreach-Schleife, die durch das gemergte $_GET und $_POST läuft
    // $merged = array_merge($_GET, $_POST);

    // foreach ($merged as $key => $value) {
    //     if (in_array($key, $keys)) {
    //         $result[$key] = $value;
    //     }
    // }

    // foreach-Schleife, die durch $keys läuft
    foreach ($keys as $key) {

        if (($value = request_get_value($key)) !== null) {
            $result[$key] = $value;
        }
    }

    return $result;
}


function redirect(string $url, $response_code = 302) {
    header("Location: $url", true, $response_code);
    exit();
}
