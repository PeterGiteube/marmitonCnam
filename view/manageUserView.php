<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper col-md-12 col-xs-12" class="d-flex flex-column">
    <div class="container-fluid">
        <div class="">
        <h1 class="p-3 mb-2 text-dark">Tableaux des utilisateurs</h1>
        <button class="btn btn-outline-secondary">Ajouter un utilisateur</button>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td scope="col">ID</td>
                <td>Pseudo</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Mail</td>
                <td>Téléphone</td>
                <td>Ville</td>
                <td>Rôle</td>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($users); $i++) {
                echo $users[$i];
            }
            ?>
            </tbody>
        </table>
    </div>
</div>