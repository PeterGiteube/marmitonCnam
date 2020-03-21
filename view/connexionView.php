<?php $this->title = "Connexion" ?>

<?php $index = Configuration::get("index") ?>

<div class="border border-primary rounded mt-5 p-5 blockCenter">
    <h1 class="text-center mb-5">Connexion</h1>
    <form method="post" action="<?= $index . "/login" ?>">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Nom d'utilisateur...">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe...">
        </div>
        <button type="submit" class="btn btn-primary float-right ml-2">Connexion</button>
        <a href="<?= $index ?>" class="float-right text-decoration-none btn btn-secondary">Retour</a>
        <br>
    </form>
</div>

<?php echo $error ?>