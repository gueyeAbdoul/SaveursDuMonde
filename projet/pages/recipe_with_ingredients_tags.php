<?php
require __DIR__.'/../config.php';
session_start();
require $GLOBALS['PHP_DIR']."class/Autoloader.php" ;
Autoloader::register();
    use bdedition\Display;

    $recipe = new Display();
    $recipe_id = $_GET['id'];
    $_SESSION['recipe_id'] = $_GET['id'];

    $displayRecipe = $recipe->displayRecipe($recipe_id);
    $descriptions = $recipe->displayDesc($recipe_id);
    $ingredients = $recipe->displayRecipeWithIngredients($recipe_id);
    $tags = $recipe->displayRecipeWithTags($recipe_id);

    ob_start();?>
        <div id="return-welcom"><a href="acceuil.php"> Return Welcome Website </a></div>
        <div class="divs">

            <?php if(!empty($_SESSION['recipe_id'])):?>

                <div id="display-recipe">
                    <div>
                        <?php foreach ($displayRecipe as $recipe_item){
                            $recipe_item->getHTML();
                        }?>
                        <p>
                            <?php foreach ($descriptions as $desc){
                                $desc->displayDescription();
                            }?>
                        </p>

                    </div>

                    </div>
                    <div class="description1">
                        <div class="contain">
                            <h2> Tags à la recette</h2>
                            <div id="tag-content">
                                <?php foreach ($tags as $tag) {
                                    $tag->getHTML();
                                } ?>
                            </div>
                    </div>

                </div>
                <div id="elt">
                    <div class="contain">
                        <h2> Ingredients à la Recette</h2>
                        <div id="ingredient-content">
                            <?php foreach ($ingredients as $item): ?>
                                <?= $item->getHTML(); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>
                </form>
            <?php endif;?>
        </div>

        <!-- Formulaire pour editer une recette soit en le modifiant par ses attributs
             ou soit en ajoutant d'autres ingredients ou tags -->
        <form method="post" id="form"
              action="editRecipe.php"
              class="display" enctype="multipart/form-data">
            <div id="back">
                <div id="button">
                    <button id="ed_title" class="add-btn" type="button">Edit title</button>
                    <button id="ed_img" class="add-btn" type="button">Edit image</button>
                    <button id="ed_des" class="add-btn" type="button">Edit description</button>
                    <button  name="valid" type="submit" class="add-btn">Valider</button>
                </div>

            </div>
            <input type="hidden" name="id-recipe" value="<?= $_SESSION['recipe_id']?>">
        </form>


    <?php
    $content = ob_get_clean();
    Template::render($content);
