<?php declare(strict_types=1);

    // require_once 'bootstrap.php';

    // Login redirects here after a successful login
    $redirect_to = 'home';

    $errors = [];

    if (request_is('POST')) {

        if (! filter_var(request('email'), FILTER_VALIDATE_EMAIL) ) {
            $errors['email'] = '<p class="error">Bitte eine valide email Adresse eingeben.</p>';
        }

        if (empty(request('password'))) {
            $errors['password'] = '<p class="error">Bitte geben Sie Ihr Passwort ein.</p>';
        }

        if (!$errors) {
            $email = db_escape($db, request('email'));

            $sql = "SELECT * FROM `users` WHERE email = '$email'";
            $user = db_select($db, $sql)[0] ?? null;

            if ($user && password_verify(request('password'), $user['password'])) {

                // TODO use login helper
                session('user', $user);
                redirect("?page=$redirect_to");

            } else {
                $errors['credentials'] = '<p class="error">Ihre Anmeldedaten stimmen nicht.</p>';
            }
        }
    }
?>
<main>
    <h1>Anmeldung</h1>
    <div class="clearfix">
        <figure class="hinweisfig"><img src="./public/images/warning-icon.png" width="30" alt="hinweis"></figure>
        <p class="hinweis">
            email: 1@2.de passwort: 123 <br>
            email: 2@2.de passwort: 123 <br>
            email: micki@reh.de passwort: 123
        </p>
    </div>
    <?= $errors['credentials'] ?? ''?>

    <form action="?page=login" method="POST" class="form" id="loginform">
        <div>
            <label for="email">Email <span class="reqlabel">* Pflichtfeld</span></label>
            <input type="text" name="email" id="email" value="<?= e(request('email') ?? '') ?>">
            <?=$errors['email'] ?? ''?>
        </div>

        <div>
            <label for="password">Passwort <span class="reqlabel">* Pflichtfeld</span></label>
            <input type="password" name="password" id="password">
            <?=$errors['password'] ?? ''?>
        </div>

        <div>
            <button type="submit">Anmelden</button>
        </div>
    </form>

    <p>Noch keinen Account? <a href="?page=register">Hier registrieren</a>.</p>
</main>