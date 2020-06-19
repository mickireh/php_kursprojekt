<?php declare(strict_types=1);

// Der Pfad ist immer von der (Datei im public Ordner aus gesehen - geändert!) index.php aus
const HELPERS = './helpers/';

require_once HELPERS.'db_helpers.php';
require_once HELPERS.'view_helpers.php';
require_once HELPERS.'request_helpers.php';
require_once HELPERS.'session_helpers.php';

$db = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'hirschm_songlist',
    'port' => 3306,             // Optional, default: 3306
    'charset' => 'utf8mb4'      // Optional, default: utf8mb4
]);

$pages = [
    'login',
    'register',
    'home',
    'logout',
    'add',
    'bosse',
    'music',
    'songlist',
    'imprint',
    'contact',
    'answer'
];


// Your global Constants, Variables and functions go here



if (request_is('POST') && request('liked') == 1) {

    if (auth_user()) {
        db_insert($db, 'likes', [
            'user_id' => auth_user()['uid'],
            'image_id' => request('image_id')
        ]);
    } 

    // var_dump($db);
    // var_dump(request('liked'));
    // redirect('?page=bosse');
};

if (request_is('POST') && request('liked') == 2) {

    var_dump(request('image_id'));
    var_dump((int)request('image_id'));

    $sql = "DELETE FROM `likes` WHERE `image_id` = " . request('image_id') . " AND `user_id` = " . auth_user()['uid'];
    db_query($db, $sql);

    // var_dump(request('liked'));
    // var_dump(auth_user()['uid']);
    // var_dump(request('image_id'));



};