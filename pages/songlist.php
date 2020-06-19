<?php declare(strict_types=1);

$errors = [];
$songs = db_select($db, 'SELECT *, `songs`.`id` AS `song_id` FROM `songs` ' .
' JOIN `bands` ON `bands`.`id` = `songs`.`band_id`' .  
' ORDER BY `songs`.`song` ASC');  

// nur wegen sortierung 2te anfrage ; TODO: array $songs sortieren nach band arraycolumn etc.
$bands = db_select($db, 'SELECT *, `songs`.`id` AS `song_id` FROM `songs` ' .
' JOIN `bands` ON `bands`.`id` = `songs`.`band_id`' .  
' ORDER BY `bands`.`band` ASC');  

// var_dump($songs);
// var_dump($songs[0]['song']);

$letterArray = [];
foreach ($songs as $song) {
    $letter = substr($song['song'],0,1);
    // var_dump($letter);

    // dynamically create arrays with firstletter and push the song item
    // check with isset if varialbe exists 
    if (isset(${'array' . $letter})) {
        array_push(${'array' . $letter},$song);
    } else {
        ${'array' . $letter} = [];
        array_push($letterArray,$letter);
        array_push(${'array' . $letter},$song);
    }
};

$bandArray = [];
foreach ($bands as $song) {
    $bandid = $song['band_id'];
    // var_dump($bandid);

    if (isset(${'array' . $bandid})) {
        array_push(${'array' . $bandid},$song);
    } else {
        ${'array' . $bandid} = [];
        array_push($bandArray,$bandid);
        array_push(${'array' . $bandid},$song);
    }
};
// var_dump($bandArray,$array2);
// var_dump($arrayB,$arrayT,$arrayP);
// var_dump($letterArray);


// *******************************************************************************************************
// FALLBACK
// Funktionen für die ausgabe. Link und Textfile
// 
function getLink(array $data) {
    if ($data['tabs'] === 'NA') {
        $link = '<p>kein Eintrag</p>';
    } else {
        $link = '<p><a href="'.$data['tabs'].'" target="_blank">Tabs</a></p>';
    }
    return $link;
};

function getSongText(array $data,int $outputswitch) {
    if ($data['file'] !== 'NA') {

        $text = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/musicapp/public/data/" . $data['file']);
        $text = explode("\n", $text);
        if ($outputswitch === 1) {
            $text = "<p>".implode("</p><p>",$text)."</p>";
            return $text;
        } else {
            $text = implode("\n",$text);
            return $text;
        }
        // $text = "<p>".implode("</p><p>",$text)."</p>";
    } else {
        return null;
    }
};

// **********************************************************************************
// specihern nach edit. TODO
if (request_is('POST') && request('action') === 'save') {

    redirect('?page=songlist');

};
// **********************************************************************************

// für die divs
$count = 0;
// Variablen $songs an JS übergeben
$jsarray = json_encode($songs);
// var_dump($jsarray);
echo "
    <script>
        var songs = $jsarray;
    </script>
    ";
?>
<main>
    <h1>LiederListe</h1>
<?php if (auth_user()) : ?>
    <a href="?page=add" title="Lied hinzufügen">Lied hinzufügen</a>
<?php endif; ?>
    <div class="clearfix">
        <figure class="hinweisfig"><img src="./public/images/warning-icon.png" width="30" alt="hinweis"></figure>
        <div class="hinweis">
        <ul>
            <li>Editieren ist nicht möglich.</li>
            <li>PHP Fallback: Funktioniert zum Anzeigen. Editieren kann angezeigt werden, wird aber nicht in die DB geschrieben.</li>
        </ul>
</div>
    </div>
    <form action="?page=songlist" method="POST">
        <button type="submit" name="bysong" value="bysong">By Song</button>
        <button type="submit" name="byband" value="byband">By Band</button>
    </form>
    <!-- den btn nur ins JS -->
    <button id="unfold" class="hide">Show all</button>
<!-- unten, hat sich so entwickelt -->
<!-- sortieren nach Songs oder Bands -->
<!-- alternative idee: gewünschte arrays nach JS übergeben, dann html struktur -->
<!-- alternative idee 2: in eigene funktionen, nicht mit php injected html  -->

<?php if(request_is('GET') || request_is('POST') && request('bysong')) : ?>
<form action="?page=songlist" method="POST">
<?php foreach ($letterArray as $li) : ?>
    <?php if ($count === 0) : ?>
        <div class="clearfix">
    <?php endif;  ?>

        <div class="col4 letter">
            <h3><?= $li ?> <span><?= count(${'array' . $li})  ?></span></h3>
            <ul>
                <?php foreach (${'array' . $li} as $song_) : ?>
                    <li>
                        <input type="hidden" name="song_id" value="<?=$song_['song_id']?>">
                        <button type="submit" class="entry" name="entry" value="<?=$song_['song_id']?>"><?= $song_['song'] ?><span> - <?= $song_['band'] ?></span></button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php if ($count === 3 || end($letterArray) === $li) : ?>
            </div>
            <?php $count = -1 ;  ?>
        <?php endif;  ?>
        <?php $count++ ;  ?>
    <?php endforeach; ?>
</form>
<?php endif;  ?>


<?php if(request_is('POST') && request('byband')) : ?>
<form action="?page=songlist" method="POST">
    <?php foreach ($bandArray as $band) : ?>
        <?php if ($count === 0) : ?>
            <div class="clearfix">
        <?php endif;  ?>

        <div class="col4 letter">
            <h3><?= ${'array'.$band}[0]['band'];?> <span><?= count(${'array' . $band})  ?></span></h3>
            <ul>
                <?php foreach (${'array' . ((int)$band)} as $song_) : ?>
                    <li>
                        <input type="hidden" name="song_id" value="<?=$song_['song_id']?>">
                        <button type="submit" class="entry" name="entry" value="<?=$song_['song_id']?>"><?= $song_['song'] ?></button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php if ($count === 3 || end($bandArray) === $band) : ?>
            </div>
            <?php $count = -1 ;  ?>
        <?php endif;  ?>
        <?php $count++ ;  ?>
    <?php endforeach; ?>
</form>
<?php endif;  ?>


<!-- PHP fallback if JS is deactivated -->
<!-- if auth_user() zeige buttons an. action= value= -->
<?php if(request_is('POST') && request('entry') || request_is('POST') && request('action')) : ?>
    <?php if (auth_user()) : ?>
    <form action="?page=songlist" method="POST">
    <div class="output clearfix">
        <?php foreach ($songs as $song_) : ?>
            <?php if ($song_['song_id'] === request('entry')) : ?>
                <?php if (request('action') === 'edit') : ?>
                    <input type="hidden" name="entry" value="<?=$song_['song_id']?>">
                    <input type="text" name="" value="<?=$song_['song'];?>">
                    <input type="text" name="" value="<?=$song_['band'];?>">
                    <input type="text" name="" value="<?=$song_['tabs'];?>">
                    <textarea name="" id="" ><?=getSongText($song_,0);?></textarea>
                    <button type="submit" name="action" value="save">Speichern</button>
                    <button type="submit" name="entry" value="<?=$song_['song_id']?>">abbrechen</button>
                <?php else : ?>
                    <div class="col2">
                        <input type="hidden" name="entry" value="<?=$song_['song_id']?>">
                        <h3><?=$song_['song'];?></h3>
                        <h4><?=$song_['band'];?></h4>
                        <?=getLink($song_); ?>
                        <button type="submit" name="action" value="edit">ändern</button>
                    </div>
                    <div class="col2">
                        <?=getSongText($song_,1); ?>
                    </div>
                <?php endif;  ?>
            <?php endif;  ?>
        <?php endforeach; ?>
        </div>
        </form>
    <?php else : ?>
        <div class="output clearfix">
        <?php foreach ($songs as $song_) : ?>
            <?php if ($song_['song_id'] === request('entry')) : ?>
            <div class="col2">
                <h3><?=$song_['song'];?></h3>
                <h4><?=$song_['band'];?></h4>
                <?=getLink($song_); ?>
            </div>
            <div class="col2">
                <?=getSongText($song_,1); ?>
            </div>
            <?php endif;  ?>
        <?php endforeach; ?>
        </div>
    <?php endif;  ?>
<?php endif;  ?>
</main>