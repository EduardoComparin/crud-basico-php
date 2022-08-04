<?php
require_once   $_SERVER['DOCUMENT_ROOT'] .'\config\constante.php';
require_once  $dirProjeto .'\repository\categoria.php';


if(isset($_POST) && !empty($_POST)){
    $categoriaDb = new CategoriaDb();
    $categoriaDb->salvar($_POST);
    header('Location: ' . $url . '/categories.php');
    exit();
}

if(isset($_GET['delete'])){
    $categoriaDb = new CategoriaDb();
    $categoriaDb->delete($_GET['delete']);
    header('Location: ' . $url . '/categories.php');
    exit();
}


if(isset($_GET['edit'])){
    $categoriaDb = new CategoriaDb();
    $categoria = base64_encode(json_encode($categoriaDb->buscaCategoria($_GET['edit'])->fetch_assoc()));
    header('Location: ' . $url . '/addCategory.php?edit='.$categoria);
    exit();
}

?>