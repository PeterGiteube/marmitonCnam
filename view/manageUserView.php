<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des utilisateurs</h1>
        <button class="btn btn-outline-secondary f-right mb-2">Ajouter un utilisateur</button>
        <table id="user-table" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Rôle</th>
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