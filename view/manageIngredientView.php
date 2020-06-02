<?php include_once "adminHeader.php"; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div class="container-fluid">
        <h1 class="p-3 mb-2 text-dark">Tableaux des ingrédients</h1>
        <table id="ingredient-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Catégorie ingrédient</th>
                    <th>Éditer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($ingredients); $i++) {
                    echo $ingredients[$i];
                }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="delete-ingredient-modal" tabindex="-1" role="dialog" aria-labelledby="delete-ingredient-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label-modal">Confirmer suppression</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de bien vouloir supprimer cet ingrédient ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" id="confirm-delete-ingredient" class="btn btn-primary">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>