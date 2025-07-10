<?php

namespace bdedition;
use pdo_config\PdoConfig;
use recipe\RecipeDB;

include __DIR__ . "/../../DB_config.php" ;


class Edition extends PdoConfig
{
    public const RECIPE_DIR = "recipes_pictures/" ;
    public const INGREDIENT_DIR = "ingredients_pictures/" ;
    private $recipe;

    public function __construct(){
        // appel au constructeur de la classe pere qui herite de Pdo
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']) ;
        $this->recipe = new RecipeDB();

    } // fin du constructeur


    //  Cette fonction permet de mettre à jour une recette
    public function updateRecette($recipeId, $title = null, $description = null, $imgFile = null,$ings = null, $tags = null,$quantity=null,$imgIngredient=null) {
        $cmptr = 0;
        $cmptr1 = 0;
        $recette_id=$_SESSION['recipe_id'];

        if ($title != null) {
            $this->updateTitreRecipe($title, $recipeId);
        }

        if ($description != null) {
            $this->updateDescriptionRecipe($recipeId, $description);
        }

        if ($imgFile != null && $imgFile !== UPLOAD_ERR_NO_FILE) {
            $this->updateImgRecipe($recipeId, $imgFile);
        }
        foreach ($ings as $ingredient){
            $ingredient_id = $this->recipe->createIngredient($ingredient,$cmptr,$quantity[$cmptr],$imgIngredient);
            $this->recipe->createIngredientRecette($ingredient_id,$recette_id);
            $cmptr++;
        }

        foreach ($tags as $tag){
            $tag_id = $this->recipe->createTag($tag,$cmptr1);
            $this->recipe->createTagRecette($tag_id,$recette_id);
            $cmptr1++;
        }
    }



    // cette fonction permet d'editer unique l'image de la reccette
    // Si l'utilsateur fait juste changer l'image 
    public function updateImgRecipe($id, $imgFile) {
        $imgName = null;
        // enregistrement du fichier uploadé
        if ($imgFile != null && $imgFile['error'] !== UPLOAD_ERR_NO_FILE) {
            $tmpName = $imgFile['tmp_name'];
            $imgName = $imgFile['name'];
            $imgName = urlencode(htmlspecialchars($imgName));

            $dirname = $GLOBALS['PHP_DIR'] . self::RECIPE_DIR;
            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("NOT UPLOADED");
        } else {
            echo "NO IMAGE !!!!";
            return;
        }

        $query = "UPDATE Recette SET photo = :photo WHERE id = :id";
        $params = [
            'photo' => $imgName,
            'id' => $id
        ];
        $this->exec($query, $params);
    }


    // cette fonction permet d'editer unique sa description de la reccette
    // Si l'utilsateur fait juste changer sa description 
    public function updateDescriptionRecipe($id, $description) {
        $query = "UPDATE Recette SET description = :description WHERE id = :id";
        $params = [
            'description' => $description,
            'id' => $id
        ];
        $this->exec($query, $params);
    }

    // cette fonction permet d'editer unique Le titre de la reccette
    // Si l'utilsateur fait juste changer Le titre
    public function updateTitreRecipe($title, $id) {
        $query = "UPDATE Recette SET title = :title WHERE id = :id";
        $params = [
            'title' => $title,
            'id' => $id
        ];
        $this->exec($query, $params);
    }


    public function updateTag($id, $htag) {
        $query = "UPDATE Tag SET htag = :htag WHERE id = :id";
        $params = [
            ':htag' => $htag,
            ':id' => $id
        ];
        $this->exec1($query, $params);
    }


}