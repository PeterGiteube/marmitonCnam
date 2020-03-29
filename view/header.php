<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $this->getIndex() ?>">Marmiton Cnam</a>
            <!-- Navbar left -->
            <div class="navbar-collapse collapse mr-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->getIndex() . "/categories" ?>">Recettes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this->getIndex() . "/produits" ?>">Ingredients</a>
                    </li>
                </ul>
            </div>

            <!-- Navbar right -->
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                    <?php if(!$this->isUserLoginIn()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex() . "/login" ?>">Connectez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex() . "/registration" ?>">Inscription</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex()  . "/profile" ?>">Profil</a>
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
        </div>
    </nav>
</header>