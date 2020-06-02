<?php $this->title = "Profile" ?>

<?php /** @var User $user */ ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="border border-secondary rounded p-5 mt-3 col-md-6">
            <?php if (!empty($errorMessage)) {
                echo "<div class='alert alert-danger' role='alert'>" . $errorMessage . "</div>";
            } ?>
            <?php if (!empty($successMessage)) {
                echo "<div class='alert alert-success' role='alert'>" . $successMessage . "</div>";
            } ?>
            <nav>
                <div class="nav nav-tabs text-center" role="tablist">
                    <a class="nav-item nav-link active w-50" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</a>
                    <a class="nav-item nav-link w-50" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security" aria-selected="false">Sécurité</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active text-center mt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <form method="POST" action="<?= $this->path('marmiton_profile_info') ?>">
                        <div class="form-group p-2">
                            <label for="change-pseudo">Pseudo</label>
                            <input name="pseudo" type="text" class="form-control" id="change-pseudo" value="<?= $user->getPseudo() ?>">
                        </div>
                        <div class="form-group p-2">
                            <label for="change-firstName">Prénom</label>
                            <input name="first-name" type="text" class="form-control" id="change-firstName" value="<?= $user->getFirstName() ?>">
                        </div>
                        <div class="form-group p-2">
                            <label for="change-lastname">Nom</label>
                            <input name="last-name" type="text" class="form-control" id="change-lastname" value="<?= $user->getLastName() ?>">
                        </div>
                        <div class="form-group p-2">
                            <label for="change-phonenumber">Téléphone</label>
                            <input name="phone" type="text" class="form-control" id="change-phonenumber" value="<?= $user->getPhoneNumber() ?>">
                        </div>
                        <div class="form-group p-2">
                            <label for="change-city">Ville</label>
                            <input name="city" type="text" class="form-control" id="change-city" value="<?= $user->getCity() ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Sauvegarder les modifications</button>
                    </form>
                </div>
                <div class="tab-pane fade text-center mt-3" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                    <form method="POST" action="<?= $this->path('marmiton_profile_security') ?>">
                        <div class="form-group p-2">
                            <label for="change-password">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="change-password" name="password">
                        </div>
                        <div class="form-group p-2">
                            <label for="new-password">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="new-password" name="new-password">
                        </div>
                        <div class="form-group p-2">
                            <label for="confirm-new-password">Confirmer nouveau mot de passe</label>
                            <input type="password" class="form-control" id="confirm-new-password" name="confirm-new-password">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Sauvegarder les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>