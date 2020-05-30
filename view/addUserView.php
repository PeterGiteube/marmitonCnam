<?php include_once "adminHeader.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Ajouter un utilisateur</h4>
                </header>
                <article class="card-body p-5">
                    <form method="POST" action="<?= $this->path('marmiton_add_user') ?>">
                        <h6>Vos identifiants : </h6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="pseudo" placeholder="Pseudo..." name="pseudo">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe..." name="password">
                        </div>
                        <h6>Vos informations personnelles : </h6>
                        <div class="form-group">
                            <input type="text" class="form-control" id="last-name" placeholder="Nom..." name="last-name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="first-name" placeholder="Prénom..." name="first-name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="mail" placeholder="E-mail..." name="mail">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone-number" placeholder="Numéro de téléphone..." name="phone-number">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="city" placeholder="Ville..." name="city">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option>USER</option>
                                <option>ADMIN</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Ajouter un utilisateur</button>
                    </form>
                </article>
            </div>
        </div>
    </div>
</div>

<?php echo $error ?>