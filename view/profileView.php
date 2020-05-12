<?php $this->title = "Profile" ?>

<?php /** @var User $user */ ?>

<div id="content-wrapper">
    <div id="profileTab" class="border border-secondary rounded p-5">
        <nav>
            <div class="nav nav-tabs text-center" role="tablist">
                <a class="nav-item nav-link active w-50" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">Profile</a>
                <a class="nav-item nav-link w-50" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Sécurité</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active text-center mt-3" id="nav-home" role="tabpanel"
                 aria-labelledby="nav-home-tab">
                <form>
                    <div class="form-group p-2">
                        <label for="changePseudo">Pseudo</label>
                        <input type="text" class="form-control" id="changePseudo" value="<?= $user->getPseudo() ?>">
                    </div>
                    <div class="form-group p-2">
                        <label for="changeFistName">Prénom</label>
                        <input type="text" class="form-control" id="changePseudo" value="<?= $user->getFirstName() ?>">
                    </div>
                    <div class="form-group p-2">
                        <label for="changePseudo">Nom</label>
                        <input type="text" class="form-control" id="changePseudo" value="<?= $user->getLastName() ?>">
                    </div>
                    <div class="form-group p-2">
                        <label for="changeCity">Ville</label>
                        <input type="text" class="form-control" id="changeCity" value="<?= $user->getCity() ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Sauvegarder les modifications</button>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

            </div>
        </div>
    </div>
</div>