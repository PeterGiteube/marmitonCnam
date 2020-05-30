<?php include_once "adminHeader.php"; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Ajouter une recette</h4>
                </header>
                <article class="card-body p-6">
                    <form method="POST" action="<?= $this->path('marmiton_add_recipe') ?>">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="upload-recipe-image">Image de recette</label>
                            <input type="file" class="form-control-file" id="upload-recipe-image" accept="image/*">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cost">Coût</label>
                                <select class="form-control" id="cost" name="cost">
                                    <option disabled selected value>...</option>
                                    <option>Bon marché</option>
                                    <option>Coût moyen</option>
                                    <option>Coût élevé</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prep_time">Temps de préparation</label>
                                <input type="text" class="form-control" id="prep_time" name="prep_time" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cooking_time">Temps de cuisson</label>
                                <input type="text" class="form-control" id="cooking_time" name="cooking_time" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="head_count">Nombre de personnes</label>
                                <input type="number" class="form-control" id="head_count" name="head_count" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="select_category">Catégories de recette</label>
                                <select class="form-control" id="select_category" name='recipe_category' required>
                                    <option selected disabled>Selectionner une catégorie</option>
                                    <?php
                                    foreach ($categories as $category) {
                                        echo '<option>' . $category->getName() . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <button id='add-ingredient' type="button" class="btn btn-primary mb-3">Ajouter un ingredient</button>
                        <div id='div-add-ingredient'>
                            <div class="form-group">
                                <input list="recherche" id="ingredient" class="form-control ing" placeholder="Rechercher ingrédients">
                                <datalist id="recherche">
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
                                        var_dump($units);
                                        foreach ($units as $unit) {
                                            echo '<option value =' . $unit->getLabel() . '>' . $unit->getLabel() . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="button" id="confirm-add-ingredient" class="btn btn-primary btn-sm offset-md-1 col-md-3">Ajouter</button>
                            </div>
                        </div>
                        <div class="form-row" id='list-ingredient'>
                        </div>
                        <div class="form-group">
                            <button type="button" id="add-step" class="btn btn-primary mb-3">Ajouter une étape</button>
                            <div id='div-add-step' class="form-group">
                                <textarea class="form-control" id="text-step"></textarea>
                                <div>
                                    <ul id='list-step'>

                                    </ul>  
                                </div>
                                <button type="button" id="confirm-step" class="btn btn-primary mt-3 float-right">Ajouter</button>
                            </div>
                        </div>
                    </div>
            <button type="submit" id="add-recipe" class="btn btn-primary float-right mt-3">Ajouter une recette</button>
            </form>
            </article>
        </div>
    </div>
</div>
</div>