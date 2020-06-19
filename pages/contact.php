<?php 
    // if (!request('nachname')) {
    //     $errors['nachname'] = '<span>Bitte geben Sie Ihren Namen ein.</span>';
    // }
    // if (!request('vorname')) {
    //     $errors['vorname'] = '<span>Bitte geben Sie Ihren Vornamen an.</span>';
    // }
    // if (!request('email')) {
    //     $errors['email'] = '<span>Bitte geben Sie Ihre Email an.</span>';
    // }
    // if (request('message') == 1) {
    //     $errors['vorname'] = '<span>Bitte geben Sie Ihren Vornamen an.</span>';
    // }
?>
<main>
    <h2>Kontakt</h2>
    <form action="?page=answer" method="POST" class="form" id="contactform">
        <fieldset>
            <!-- <legend>Kontaktformular</legend> -->
            <label class="firstlabel" for="auswahl">Thema der Kontaktaufnahme? (optional)</label>
            <select name="auswahl" id="auswahl">
                <option value="keineauswahl">-- bitte auswählen --</option>
                <option value="Webdesign">Webdesign</option>
                <option value="Bosse">Kater Bosse</option>
                <option value="music">Musik</option>
            </select>

            <div>
                <label for="nachname">Name <span class="reqlabel">* Pflichtfeld</span></label>
                <input type="text" name="nachname" id="nachname" size="25" placeholder="Nachname" value="<?= e($_SESSION['formname'] ?? '') ?>" >
                <?= $_SESSION['errorname'] ?? '' ?>
            </div>
            <div>
                <label for="vorname">Vorname <span class="reqlabel">* Pflichtfeld</span></label>
                <input type="text" name="vorname" id="vorname" size="25" placeholder="Vorname" value="<?= e($_SESSION['formvorname'] ?? '') ?>" >
                <?= $_SESSION['errorvorname'] ?? '' ?>
            </div>
            <div>
                <label for="email">Email <span class="reqlabel">* Pflichtfeld</span></label>

                <input type="text" name="email" id="email" size="25" placeholder="main@domainname.tld" title="Füll mich aus" value="<?= e($_SESSION['formemail'] ?? '') ?>" >
                <?= $_SESSION['erroremail'] ?? '' ?>
            </div>
            <label for="message">Nachricht <span class="reqlabel">* Pflichtfeld</span></label>
            <textarea name="message" id="message" placeholder="..." cols="45" rows="6"><?= e(request('message') ?? '') ?></textarea>
            <?= $_SESSION['errormessage'] ?? '' ?>
        <button type="submit">Daten absenden</button>
        </fieldset>
    </form>
</main>