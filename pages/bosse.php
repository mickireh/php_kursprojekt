<?php
    $images = db_select($db, 'SELECT * FROM `images`');

    // var_dump(request(),$_POST);

    // function anzahl likes holen
    function get_LikeCount(mysqli $db, array $data) {

        $likesCount = db_select($db,'SELECT * FROM `likes` WHERE `image_id` = ' . $data['id']);

        return count($likesCount);
    };


    // schreibe klasse ob schon selbst geliked oder geliked wurde oder weder noch
    // .liked .passiveliked .thumb-up

    // var_dump(auth_user()['uid']);

    // übergebe dynaminsch $image in schleife aus $images - alle likes des image, prüfen ob user gelikt aht 
    // übergebe je den count von dem jeweiligen image, get_LikeCount
    function write_LikeClass(mysqli $db, array $data, int $number) {

        $likesImage = db_select($db,'SELECT * FROM `likes` WHERE `image_id` = ' . $data['id']);

        if ($number === 0) {
            return 'thumb-up_';
        } else {
            if(auth_user()) {
                foreach ($likesImage as $like) {
                    if (auth_user()['uid'] === $like['user_id']) {
                        return 'liked';
                        break;
                    } 
                }
            } 
            return 'passiveliked';
        }
    };

    // title für JS und hover setzen
    function write_titleClass(mysqli $db, array $data) {
        $likesImage = db_select($db,'SELECT * FROM `likes` WHERE `image_id` = ' . $data['id']);
        // var_dump ($likesImage);

        if(auth_user()) {
            if (!empty($likesImage)) {
                foreach ($likesImage as $like) {
                    if (auth_user()['uid'] === $like['user_id']) {
                        return 'unlike';
                    } 
                }
                return 'like';
            } else {
                return 'like';
            }
        } else {
            return 'login';
        }
    };



    // likes
    // alle likes where image.id == id 
    // restraint auf combination von 2 werten? image_id + user_id darf nur einmal vorkommen. beim anlegen in sql..
    $likes = db_select($db,'SELECT * FROM `likes`');

    // var_dump($likes);


    // wenn like, muss in bootstrap. 
    if (request_is('POST') && request('liked')) {
        // db_insert($db, 'likes', [
        //     'user_id' => auth_user()['uid'],
        //     'image_id' => request('image')
        // ]);
        var_dump(request('liked'));
    };

?>

<main>
    <!-- <script>
        lightbox.option({
        'resizeDuration': 400,
        'wrapAround': true,
        'positionFromTop': 200,
        'albumLabel':"Bild %1 von %2"
        })
    </script> -->
    <div id="plslogin" class="clearfix hide">
            <figure class="hinweisfig"><img src="./public/images/warning-icon.png" width="30" alt="hinweis"></figure>
            <p class="hinweis">Bitte anmelden!</p>
    </div>
    <section class="clearfix" id="fotos">
        <h2>Bildergalerie</h2>
<?php foreach ($images as $image) : ?>
        <div class="responsive relative">
            <figure>
                <a href="./public/images/<?=$image['image']?>" data-lightbox="bosse" data-title="<?=$image['text']?>"> <img src="./public/images/<?=$image['image']?>" alt="<?=$image['text']?>" width="640" height="427"></a>
                <figcaption><?=$image['text']?></figcaption>
            </figure>
            <div class="likeBox">
                <a href="#" data-id="<?=$image['id']?>" class="likeLink <?=write_LikeClass($db,$image,get_LikeCount($db,$image));?>" title="<?=write_titleClass($db,$image)?>">
                <?=get_LikeCount($db,$image)?>
                </a>
            </div>
        </div>
<?php endforeach; ?>
    </section>
</main>