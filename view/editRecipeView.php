<?php include_once "adminHeader.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Mettre à jour la recette</h4>
                </header>
                <article class="card-body p-6">
                    <form method="POST" action="<?= $this->getIndex() . "/admin/recipe/" . $recipe->getId() . "/update" ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $recipe->getName(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="upload-recipe-image">Image de recette</label>
                            <input type="file" accept="image/x-png,image/jpeg" class="form-control-file" id="upload-recipe-image" name="recipe-image">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cost">Coût</label>
                                <select class="form-control" id="cost" name="cost">
                                    <option disabled value>...</option>
                                    <option <?php if ($recipe->getCost() === "Bon marché") echo "selected" ?>>Bon marché</option>
                                    <option <?php if ($recipe->getCost() === "Coût moyen") echo "selected" ?>>Coût moyen</option>
                                    <option <?php if ($recipe->getCost() === "Coût élevé") echo "selected" ?>>Coût élevé</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prep_time">Temps de préparation</label>
                                <input type="text" class="form-control" id="prep_time" name="prep_time" value="<?= $recipe->getPrepTime(); ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cooking_time">Temps de cuisson</label>
                                <input type="text" class="form-control" id="cooking_time" name="cooking_time" value="<?= $recipe->getCookingTime(); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="head_count">Nombre de personnes</label>
                                <input type="number" class="form-control" id="head_count" name="head_count" value="<?= $recipe->getHeadCount(); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="select_category">Catégories de recette</label>
                                <select class="form-control" id="select_category" name='recipe_category' required>
                                    <?php
                                    foreach ($categories as $category) {
                                        if ($recipe->getRecipeCategoryId() == $category->getIdCategory())
                                            echo '<option selected>' . $category->getName() . '</option>';
                                        else
                                            echo '<option>' . $category->getName() . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <button id='add-ingredient' type="button" class="btn btn-primary mb-3">Ajouter un ingredient</button>
                        <div id='div-add-ingredient'>
                            <div class="form-group">
                                <input list="recherche" autocomplete="off" id="ingredient" class="form-control ing" placeholder="Rechercher ingrédients">
                                <datalist id="recherche" >
                                    <?php
                                    foreach ($ingredients as $ingredient) {
                                        echo '<option value="' . $ingredient->getName() . '"/>';
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="number" id="quantity-ingredient" class="form-control ing" placeholder="Quantité">
                                </div>
                                <div class="form-group offset-md-1 col-md-3">
                                    <select class="form-control ing" id="select_unit">
                                        <?php
                                        foreach ($units as $unit) {
                                            echo '<option value =' . $unit->getLabel() . '>' . $unit->getLabel() . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="button" id="confirm-add-ingredient" class="btn btn-primary btn-sm offset-md-1 col-md-3">Ajouter</button>
                            </div>
                        </div>
                        <div id='list-ingredient'>
                            <?php
                            foreach ($recipeIngredients as $recipeingredient) {
                                echo '<div class=\'row mb-2\' id=\'recipe-ingredient-'. $recipeingredient->getIdRecipeIngredient().'\'>' .
                                        '<div class=\'col col-md-5\'>' .
                                            '<input type=\'text\' class=\'form-control\' name=\'ingredient[]\' value="' . $recipeingredient->getIngredient()->getName() . '">'.
                                        '</div>' .
                                        '<div class=\'col col-md-2\'>' .
                                            '<input type=\'text\' class=\'form-control\' name=\'quantity[]\' value="' . $recipeingredient->getQuantity() . '">' .
                                        '</div>' .
                                        '<div class=\'col col-md-2\'>' .
                                            '<input type=\'text\' class=\'form-control\' name=\'unit[]\' value="' . $recipeingredient->getUnit()->getLabel()  . '">' .
                                        '</div>
                                        <div class=\'col col-md-3 text-center\'>
                                            <button data-id="' . $recipeingredient->getIdRecipeIngredient() . '" id="recipe-ingredient" type=\'button\' data-target=\'#delete-recipe-ingredient-modal\' data-toggle=\'modal\' class=\'btn btn-outline-danger col-md-6 form-control\'><i class="fas fa-trash"></i></button>' .
                                        '</div>' .
                                    '</div>';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="button" id="add-step" class="btn btn-primary mb-3">Ajouter une étape</button>
                            <div id='div-add-step' class="form-group">
                                <div id="list-step">
                                    <?php
                                        foreach ($recipeSteps as $step) {
                                            echo '<div class=\'row mb-2\' id=\'step-'. $step->getId() .'\'>' .
                                                    '<div class=\'col col-md-1\'>' . 
                                                        '<label>' . $step->getNumber() . '</label>' .
                                                    '</div>' .
                                                    '<div class=\'col col-md-8\'>' . 
                                                        '<textarea type=\'text\' class=\'form-control overflow-auto resize\' name=\'step[]\'>' . $step->getDescription() . '</textarea>' .
                                                    '</div>' .
                                                    '<div class=\'col col-md-3 text-center\'>
                                                        <button data-id="' . $step->getId() . '" id="step" type=\'button\' data-target=\'#delete-step-modal\' data-toggle=\'modal\' class=\'btn btn-outline-danger col-md-6 form-control\'><i class="fas fa-trash"></i></button>' .
                                                    '</div>' .
                                                 '</div>';
                                        }
                                    ?>
                                </div>
                                <textarea class="form-control" id="text-step"></textarea>
                                
                                <button type="button" id="confirm-step" class="btn btn-primary mt-3 float-right">Ajouter</button>
                            </div>
                        </div>
            </div>
            <button type="submit" id="add-recipe" class="btn btn-success mt-3 btn-lg btn-block">Valider</button>
            </form>
            </article>
        </div>
    </div>
    <div class="modal fade" id="delete-recipe-ingredient-modal" tabindex="-1" role="dialog" aria-labelledby="delete-recipe-ingredient-modal" aria-hidden="true">
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
                    <button type="button" id="confirm-delete-recipe-ingredient" class="btn btn-primary">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-step-modal" tabindex="-1" role="dialog" aria-labelledby="delete-step-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label-modal">Confirmer suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de bien vouloir supprimer cette étape ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" id="confirm-delete-step" class="btn btn-primary">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>