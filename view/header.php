<header>
    <ul class="nav nav-pills justify-content-end">
        <?php if(!$this->isUserLoginIn()) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/marmitonCnam/login">Connectez-vous</a>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="/marmitonCnam/profil">Profil</a>
            </li>

            <?php if($this->isUserAdmin()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/marmitonCnam/admin">Administration</a>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="/marmitonCnam/logout">Déconnexion</a>
            </li>
        <?php } ?>
    </ul>
</header>