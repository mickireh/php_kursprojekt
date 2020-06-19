<?php declare(strict_types=1);
/* add song
bandname    -   `bands` durchsuchen, finden oder erstellen, refenrenzieren,
ex link - to tabs <a href, _blank>
link to file - lyrics e.g.; format: txt?,html?
  -->*/
  
// require_once 'bootstrap.php';

$errors = [];

if (request_is('POST')) {


    if (request('song') === '' ) {
        $errors['song'] = '<p class="error">Bitte ein Lied eingeben.</p>';
    
    } else {
        $song = db_escape($db, request('song'));

        $sql = "SELECT song FROM `songs` WHERE `song` = '$song'";
        $songdb = db_select($db, $sql)[0] ?? null;

        if ($songdb) {
            $errors['song'] = '<p class="error">Dieses Lied gibt es bereits.</p>';
        }
    }

    if (request('band') === '') {
        $errors['band'] = '<p class="error">Bitte einen Interpret eingeben.</p>';
    }

    if (request('tabs') === '' && empty(request('linktext'))) {
        $errors['tabs'] = '<p class="error">Bitte einen Link bereitstellen oder Box klicken.</p>';
    }
    if (!empty(request('tabs')) && request('linktext') === 'nolink' ) {
        $errors['tabs'] = '<p class="error">Bitte nicht beides.</p>';
    }

    if (empty(request('textarea')) && empty(request('songtext'))) {
        $errors['textarea'] = '<p class="error">Bitte Liedtext bereitstellen oder Box klicken.</p>';
    }
    if (!empty(request('textarea')) && request('songtext') === 'notext' ) {
        $errors['textarea'] = '<p class="error">Bitte nicht beides.</p>';
    }


    if (!$errors) {
        // band abgleichen
        $band = db_escape($db, request('band'));

        $sql = "SELECT band FROM `bands` WHERE `band` = '$band'";
        $banddb = db_select($db, $sql)[0] ?? null;

        if (!($banddb)) {
            db_insert($db, 'bands', [
                'band' => request('band')
            ]);
        }

        $sql = "SELECT id FROM `bands` WHERE `band` = '$band'";
        $band_id = db_select($db, $sql);

        if (request('linktext') === 'nolink') {
            $linktext = 'NA';
        } else {
            $linktext = request('tabs');
        }

        // var_dump(implode('',$band_id[0]));

        // for txtfile_name to DB
        $song_name = strtolower(preg_replace('/\s*/', '', request('song')));

        db_insert($db, 'songs', [
            'song' => request('song'),
            'tabs' => $linktext,
            'file' => $song_name .".txt",
            'band_id' => (implode('',$band_id[0]))
        ]);


        // ob box geklickt ist , txt wird trotzdem gesschrieben mit inhalt NA. 
        if (request('songtext') === 'notext') {
            $songtext = 'NA';
        } else {
            $songtext = request('textarea');
        }
        // CREATE TXT FILE FROM TEXTAREA
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/musicapp/public/data/" . $song_name .".txt", $songtext);

        redirect('?page=songlist');
    }

}

?>
<main>
    <form action="?page=add" method="POST" class="form" id="addform">
        <div class="relative">
            <label for="song">Song <span class="reqlabel">* Pflichtfeld</span></label>
            <input type="text" id="song" name="song" value="<?= e(request('song') ?? '') ?>">
            <?= $errors['song'] ?? '' ?>
        </div>
        <div class="relative">
            <label for="band">Band <span class="reqlabel">* Pflichtfeld</span></label>
            <input type="text"  id="band" name="band" value="<?= e(request('band') ?? '') ?>">
            <?= $errors['band'] ?? '' ?>
        </div>
        <div class="clearfix relative">
            <div class="formCol">
                <label for="tabs">Tabs <span class="reqlabel">* Pflichtfeld</span></label>
                <input class="tabgroup" type="text"  id="tabs" name="tabs" value="<?= e(request('tabs') ?? '') ?>">
                <?= $errors['tabs'] ?? '' ?>
            </div>
            <div class="checkbox formCol">
                <label for="linktext">kein Link</label>
                <input class="tabgroup" type="checkbox" name="linktext" id="linktext" value="nolink" <?=request('linktext') == 'nolink' ? 'checked' : '' ?>>

            </div>
        </div>

        <div class="clearfix">
            <div class="formCol">
                <label for="textarea">Lyrics <span class="reqlabel">* Pflichtfeld</span></label>
                <textarea name="textarea" id="textarea" cols="30" rows="10"></textarea>
                <?= $errors['textarea'] ?? '' ?>
            </div>
            <div class="checkbox formCol">
                <label for="songtext">kein Text</label>
                <input type="checkbox" name="songtext" id="songtext" value="notext" <?=request('songtext') == 'notext' ? 'checked' : '' ?>>
            </div>
        </div>
        <button type="submit">hinzufügen</button>
    </form>
</main>