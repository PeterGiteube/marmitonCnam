<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des recettes validées</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th>Nom</th>
                <th>Coût</th>
                <th>Temps de préparation</th>
                <th>Temps de cuisson</th>
                <th>Date de publication</th>
                <th>Nombre de personnes</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($recipes as $recipe) {
                echo $recipe;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>