<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $this->getIndex() ?>">Marmiton Cnam</a>
            <!-- Navbar left -->
            <div class="navbar-collapse collapse mr-auto">
                <?php if($_SESSION['user']) {?>
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$this->path('marmiton_user_recipe') ?>">Mes recettes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$this->path('marmiton_user_create_recipe')?>">Créer une recette</a>
                    </li>
                </ul>
                <?php }?>
            </div>

            <!-- Navbar right -->
            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                    <?php if (!$this->hasRole('ROLE_USER')) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex() . "/login" ?>">Connectez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex() . "/registration" ?>">Inscription</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex() . "/profile" ?>">Profil</a>
                        </li>

                        <?php if ($this->hasRole('ROLE_ADMIN')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $this->getIndex() . "/admin" ?>">Administration</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->getIndex() . "/logout" ?>">Déconnexion</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>