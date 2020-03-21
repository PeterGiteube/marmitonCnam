<header>
    <?php $index = Configuration::get('index'); ?>
    <ul class="nav nav-pills justify-content-end">
        <?php if(!$this->isUserLoginIn()) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $index . "/login" ?>">Connectez-vous</a>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $index  . "/profil" ?>">Profil</a>
            </li>

            <?php if($this->isUserAdmin()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $index  . "/admin" ?>">Administration</a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= $index  . "/logout" ?>">Déconnexion</a>
            </li>
        <?php } ?>
    </ul>
</header>