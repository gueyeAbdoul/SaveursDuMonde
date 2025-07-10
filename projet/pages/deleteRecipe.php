<?php
require __DIR__."/../config.php" ;
session_start();
require $GLOBALS['PHP_DIR']."class/Autoloader.php" ;
Autoloader::register();

    use bdedition\SearchDelete;
    $edition = new SearchDelete();
    ob_start();
    if (isset($_POST['check'])) {
        $ids = $_POST['check'];
        foreach($ids as $id){
            $edition->deleteRecipe($id);
        }
        header("Location: " . $GLOBALS['DOCUMENT_DIR'] . "index.php");
        exit();
    }

    $content = ob_get_clean();
    Template::render($content);