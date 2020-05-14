<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des recettes en attente</h1>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td scope="col">ID</td>
                <td>Nom</td>
                <td>Coût</td>
                <td>Temps de préparation</td>
                <td>Temps de cuisson</td>
                <td>Date de publication</td>
                <td>Nombre de personnes</td>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < count($recipes); $i++) {
                echo $recipes[$i];
            }
            ?>
            </tbody>
        </table>
    </div>
</div>