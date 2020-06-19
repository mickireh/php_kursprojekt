<?php declare(strict_types=1);

    // require_once 'bootstrap.php';

    $errors = [];

    if (request_is('POST')) {

        if (! filter_var(request('email'), FILTER_VALIDATE_EMAIL) ) {
            $errors['email'] = '<p class="error">Bitte geben Sie eine valide Email Adresse an.</p>';
        
        } else {
            $email = db_escape($db, request('email'));

            $sql = "SELECT email FROM `users` WHERE `email` = '$email'";
            $user = db_select($db, $sql)[0] ?? null;

            if ($user) {
                $errors['email'] = '<p class="error">Diese Email Adresse ist bereits vergeben.</p>';
            }
        }

        if (mb_strlen(request('password')) < 3) {
            $errors['password'] = '<p class="error">Passwörter müssen mindestens 3 Zeichen lang sein.</p>';
        }

        if (request('password_confirm') !== request('password')) {
            $errors['password_confirm'] = '<p class="error">Die Passwörter stimmen nicht überein.</p>';
        }

        if (empty(request('name'))) {
            $errors['name'] = '<p class="error">Bitte geben Sie einen Namen ein.</p>';
        }

        if (!$errors) {
            db_insert($db, 'users', [
                'email' => request('email'),
                'password' => password_hash(request('password'), PASSWORD_DEFAULT),
                'name' => request('name')
            ]);

            redirect('?page=login');
        }
    }

?>
<div>
    <h1>Registrierung</h1>

    <form action="?page=register" method="POST" class="form" id="regform" novalidate>
        <div>
            <label for="email">Email <span class="reqlabel">* Pflichtfeld</span></label>
            <input required type="email" name="email" id="email" value="<?= e(request('email') ?? '') ?>">
            <?= $errors['email'] ?? '' ?>
        </div>
        <div>
            <label for="name">Name <span class="reqlabel">* Pflichtfeld</span></label>
            <input required type="text" name="name" id="name" value="<?= e(request('name') ?? '') ?>">
            <?= $errors['name'] ?? '' ?>
        </div>

        <div>
            <label for="password">Passwort <span class="reqlabel">* Pflichtfeld</span></label>
            <input required type="password" name="password" id="password">
            <?= $errors['password'] ?? '' ?>
        </div>

        <div>
            <label for="password_confirm">Passwort bestätigen <span class="reqlabel">* Pflichtfeld</span></label>
            <input required type="password" name="password_confirm" id="password_confirm">
            <?= $errors['password_confirm'] ?? '' ?>
        </div>

        <div>
            <button type="submit">Registrieren</button>
        </div>
    </form>

    <p>Bereits registriert? <a href="?page=login">Hier anmelden</a>.</p>
</div>