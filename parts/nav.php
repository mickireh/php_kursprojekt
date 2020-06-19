<nav>
    <ul>
        <!-- function setActive in view_helpers -->
        <li tabindex="0"><a tabindex="-1" href="?page=home" title="Startseite" class="<?=setActive($page,'home')?>">Startseite</a></li>

        <li tabindex="0" ><a tabindex="-1" href="?page=bosse" title="Bosse" class="<?=setActive($page,'bosse')?>">Bosse</a></li>
        <li tabindex="0" class="more"><a tabindex="-1" href="?page=music" title="Musik" class="<?=setActive($page,'music')?>">Musik</a>
            <ul>
                <li tabindex="0"><a tabindex="-1" href="?page=songlist" title="Songliste" class="<?=setActive($page,'songlist')?>">Songliste</a>
<?php if (auth_user()) : ?>
                    <ul>
                        <li tabindex="0"><a tabindex="-1" href="?page=add" title="Lied hinzufügen" class="<?=setActive($page,'add')?>">Lied hinzufügen</a></li>
                    </ul>
<?php endif ?>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="navright">
        <li tabindex="0"><a tabindex="-1" href="?page=contact" title="Kontakt" class="<?=setActive($page,'contact')?>">Kontakt</a></li>
        <li tabindex="0"><a tabindex="-1" href="?page=imprint" title="Impressum" class="<?=setActive($page,'imprint')?>">Impressum</a></li>
<?php if (auth_user()) : ?>
            <li tabindex="0"><a tabindex="-1" href="?page=logout" title="Abmelden" class="<?=setActive($page,'logout')?>">Abmelden</a></li>
<?php else : ?>
            <li tabindex="0"><a tabindex="-1" href="?page=register" title="Registrieren" class="<?=setActive($page,'register')?>">Registrieren</a></li>
            <li tabindex="0"><a tabindex="-1" href="?page=login" title="Anmelden" class="<?=setActive($page,'login')?>">Anmelden</a></li>
<?php endif ?>
    </ul>
</nav>

<div id="menu-bar">
    <div id="menu">
        <div id="bar1" class="bar"></div>
        <div id="bar2" class="bar"></div>
        <div id="bar3" class="bar"></div>
    </div>
    <ul class="nav" id="navi">
        <li><a href="?page=home" title="Startseite" class="<?=setActive($page,'home')?>">Startseite</a></li>
        <li><a href="?page=bosse" title="Bosse" class="<?=setActive($page,'bosse')?>">Bosse</a></li>
        <li><a href="?page=music" title="Musik" class="<?=setActive($page,'music')?>">Musik</a>
        <li><a href="?page=contact" title="Kontakt" class="<?=setActive($page,'contact')?>">Kontakt</a></li>
        <li><a href="?page=imprint" title="Impressum" class="<?=setActive($page,'imprint')?>">Impressum</a></li>
<?php if (auth_user()) : ?>
        <li><a href="?page=logout" title="Abmelden" class="<?=setActive($page,'logout')?>">Abmelden</a></li>
<?php else : ?>
        <li><a href="?page=register" title="Registrieren" class="<?=setActive($page,'register')?>">Registrieren</a></li>
        <li><a href="?page=login" title="" class="<?=setActive($page,'login')?>">Anmelden</a></li>
<?php endif ?>
    </ul>
</div>
