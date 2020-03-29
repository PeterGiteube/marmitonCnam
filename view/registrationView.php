<?php $this->title = "Inscription" ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Inscription</h4>
                </header>
                <article class="card-body">
                    <form action="<?= $this->getIndex() . '/registration'?>" method="post">
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Nom </label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="col form-group">
                                <label>Prenom</label>
                                <input type="text" class="form-control" placeholder=" ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Ville</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input class="form-control" type="password" placeholder="Mot de passe">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" placeholder="Confirmation Mot de passe">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> S'inscrire  </button>
                        </div>
                    </form>
                </article>
                <div class="border-top card-body text-center">Vous possédez déjà un compte ?  <a href="<?= $this->getIndex() . '/login' ?>">Connectez-vous</a></div>
            </div>
        </div>

    </div>
</div>



