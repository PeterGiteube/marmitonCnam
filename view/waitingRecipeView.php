<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des recettes en attente</h1>

        <table class="table table-bordered table-recipe">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th>Nom</th>
                <th>Coût</th>
                <th>Temps de préparation</th>
                <th>Temps de cuisson</th>
                <th>Date de publication</th>
                <th>Nombre de personnes</th>
                <th>Éditer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($recipes as $recipe) {
                echo $recipe;
            } ?>
            </tbody>
        </table>
        <?php include_once "recipeModalView.php";?>
    </div>
</div>
</div>