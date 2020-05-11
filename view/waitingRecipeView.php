<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des recettes en attente</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td scope="col">id_recette</td>
                <td>nom</td>
                <td>cout</td>
                <td>temps préparation</td>
                <td>temps cuisson</td>
                <td>date publication</td>
                <td>nombre personnes</td>
            </tr>
            </thead>
            <tbody>
            <?php
            /*$result = array_map(function ($recipe) {
                return "<tr>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                                <td>" . $recipe . "</td>
                            <tr>";
            }, $requestRecipe);


            for ($i = 0; $i < count($requestUser); $i++) {
                echo $result[$i];
            }*/
            ?>
            </tbody>
        </table>
    </div>
</div>