<?php include_once "adminHeader.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Mettre à jour les données de l'utilisateur</h4>
                </header>
                <article class="card-body p-5">
                    <form method="POST" action="<?= $this->getIndex() . "/admin/user/" . $user->getId() . "/update" ?>">
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" placeholder="Pseudo..." name="pseudo" value="<?= $user->getPseudo();?>">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Nom</label>
                            <input type="text" class="form-control" id="last-name" placeholder="Nom..." name="last-name" value="<?= $user->getLastName();?>">
                        </div>
                        <div class="form-group">
                            <label for="first-name">Prénom</label>
                            <input type="text" class="form-control" id="first-name" placeholder="Prénom..." name="first-name" value="<?= $user->getFirstName();?>">
                        </div>
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="email" class="form-control" id="mail" placeholder="E-mail..." name="mail" value="<?= $user->getEmail();?>">
                        </div>
                        <div class="form-group">
                            <label for="phone-number">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="phone-number" placeholder="Numéro de téléphone..." name="phone-number" value="<?= $user->getPhoneNumber();?>">
                        </div>
                        <div class="form-group">
                            <label for="city">Ville</label>
                            <input type="text" class="form-control" id="city" placeholder="Ville..." name="city" value="<?= $user->getCity();?>">
                        </div>
                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <input type="text" class="form-control" id="role" placeholder="Rôle..." name="role" value="<?= $user->getRole();?>">
                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-3">Mettre à jour</button>
                    </form>
                </article>
            </div>
        </div>
    </div>
</div>
</div>