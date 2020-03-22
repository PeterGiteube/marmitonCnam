<header>
    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Marmiton Cnam</a>
        <div class="navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <?php if(!$this->isUserLoginIn()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->getIndex() . "/login" ?>">Connectez-vous</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->getIndex()  . "/profil" ?>">Profil</a>
                    </li>

                    <?php if($this->isUserAdmin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex()  . "/admin" ?>">Administration</a>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->getIndex()  . "/logout" ?>">Déconnexion</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>