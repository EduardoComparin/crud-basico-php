<?php
require_once   $_SERVER['DOCUMENT_ROOT'] .'\config\constante.php';
require_once  $dirProjeto .'\repository\produto.php';

if(isset($_POST) && !empty($_POST)){
    $produtoDb = new ProdutoDb();
    $produtoDb->salvar($_POST);
    header('Location: ' . $url . '/products.php');
    exit();
}

if(isset($_GET['delete'])){
    $produtoDb = new ProdutoDb();
    $produtoDb->delete($_GET['delete']);
    header('Location: ' .  $url . '/products.php');
    exit();
}

if(isset($_GET['edit'])){
    $produtoDb = new ProdutoDb();
    $produto = base64_encode(json_encode($produtoDb->buscaProduto($_GET['edit'])->fetch_assoc()));
    header('Location: ' . $url . '/addProduct.php?edit='.$produto);
    exit();
}

?>