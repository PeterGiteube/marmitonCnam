<?php $this->title = "Accueil" ?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">MARMITON CNAM</h1>
        <p class="lead text-muted">De délicieuses recettes inspirées des plus grands chefs.</p>
    </div>
</section>

<div class="album text-muted">
    <div class="container">

        <div class="row">
            <?php 
                foreach($recipes as $recipe) {
                    echo $recipe;
                }
            ?>
        </div>
    </div>
</div>