<?php include_once "adminHeader.php"; ?>

<?php $this->title = "Ajouter un ingrédient" ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border border-primary rounded mt-5">
                <header class="card-header text-center">
                    <h4 class="card-title mt-3">Ajouter un ingrédient</h4>
                </header>
                <article class="card-body p-6">
                    <form method="POST" action="<?= $this->path('marmiton_add_ingredient') ?>">
                        <div class="form-group">
                            <input type="text" id="ingredient" name="ingredient" class="form-control ing" placeholder="Nom ingrédient">
                        </div>
                        <div class="form-group">
                            <input list="recherche-category-ingredient" id="ingredient-category" name="ingredient-category" class="form-control ing" placeholder="Rechercher catégorie ingrédient">
                            <datalist id="recherche-category-ingredient">
                                <?php
                                foreach ($ingredientCategories as $ingredientCategory) {
                                    echo '<option value="' . $ingredientCategory->getName() . '"/>';
                                }
                                ?>
                            </datalist>
                        </div>
                        <button type="submit" id="add-ingredients" class="btn btn-primary float-right mt-3">Ajouter un ingrédient</button>
                    </form>
                </article>
            </div>
        </div>
    </div>
</div>
</div>