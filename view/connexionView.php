<?php $this->title = "Connexion" ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Connexion</h4>
                </header>
                <article class="card-body p-5">
                    <?php if(!empty($message)) { echo "<div class='alert alert-success' role='alert'> $message</div>"; } ?>
                    <form method="post" action="<?= $this->getIndex() . "/login" ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Nom d'utilisateur...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe...">
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-2">Connexion</button>
                        <a href="<?= $this->getIndex() ?>" class="float-right text-decoration-none btn btn-secondary">Retour</a>
                        <br>
                    </form>
                </article>
                </div>
        </div>
    </div>
</div>

<?php echo $error ?>