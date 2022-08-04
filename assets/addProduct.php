<?php
include  $_SERVER['DOCUMENT_ROOT'] . '\config\constante.php';
require_once  $dirProjeto . '\repository\categoria.php';
require_once  $dirProjeto . '\repository\produto.php';

$categoriaDb = new CategoriaDb();
$todasCategorias = $categoriaDb->buscaTodasCategorias();

if (!isset($_GET['edit'])) {
    $tipo = "New";
    $produto = array(
        "id" =>  "",
        "nome" =>  "",
        "sku" =>  "",
        "descricao" =>  "",
        "quantidade" =>  "",
        "preco" =>  "",
        "categoria" =>  ""
    );
} else {
    $tipo = "Edit";
    $produto = json_decode(base64_decode($_GET['edit']), true);
}

?>
<!doctype html>
<html ⚡>

<head>
    <title>Webjump | Backend Test | Add Product</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <style amp-boilerplate>
        body {
            -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
            animation: -amp-start 8s steps(1, end) 0s 1 normal both
        }

        @-webkit-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-moz-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-ms-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @-o-keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }

        @keyframes -amp-start {
            from {
                visibility: hidden
            }

            to {
                visibility: visible
            }
        }
    </style><noscript>
        <style amp-boilerplate>
            body {
                -webkit-animation: none;
                -moz-animation: none;
                -ms-animation: none;
                animation: none
            }
        </style>
    </noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async src="js/validaCampos.js"></script>
</head>
<!-- Header -->
<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
    <div class="close-menu">
        <a on="tap:sidebar.toggle">
            <img src="images/bt-close.png" alt="Close Menu" width="24" height="24" />
        </a>
    </div>
    <a href="dashboard.php"><img src="images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
    <div>
        <ul>
            <li><a href="categories.php" class="link-menu">Categorias</a></li>
            <li><a href="products.php" class="link-menu">Produtos</a></li>
        </ul>
    </div>
</amp-sidebar>
<header>
    <div class="go-menu">
        <a on="tap:sidebar.toggle">☰</a>
        <a href="dashboard.php" class="link-logo"><img src="images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
    </div>
    <div class="right-box">
        <span class="go-title">Administration Panel</span>
    </div>
</header>
<!-- Header -->
<!-- Main Content -->
<main class="content">
    <h1 class="title new-item"><?php echo  $tipo; ?> Product</h1>

    <form method="post" name="produto" action="..\controller\produto.php">
        <div class="input-field">
            <input value="<?php echo $produto['id'] ?>" name="id" type="hidden" />
        </div>
        <div class="input-field">
            <label for="sku" class="label">Product SKU</label>
            <input required value="<?php echo $produto['sku'] ?>" name="sku" type="text" id="sku" class="input-text"  minlength="8" maxlength="10" onkeyup="setSku(this)"/>
        </div>
        <div class="input-field">
            <label for="name" class="label">Product Name</label>
            <input required value="<?php echo $produto['nome'] ?>" name="nome" type="text" id="name" class="input-text" onkeyup="setString(this)" />
        </div>
        <div class="input-field">
            <label for="price" class="label">Price</label>
            <input required value="<?php echo $produto['preco'] ?>" name="preco" type="text" id="price" class="input-text" maxlength="13" onblur="setDecimal(this)" />
        </div>
        <div class="input-field">
            <label for="quantity" class="label">Quantity</label>
            <input required value="<?php echo $produto['quantidade'] ?>" name="quantidade" type="text" id="quantity" class="input-text" maxlength="11" onkeyup="setInteiro(this)" />
        </div>
        <div class="input-field">
            <label for="category" class="label">Categories</label>
            <select required name="categoria[]" multiple id="category" class="input-text">

                <?php while ($linha = $todasCategorias->fetch_assoc()) { ?>

                    <option <?php
                            echo preg_match("/{$linha['descricao']}/", $produto['categoria']) ? "selected" : ""; ?> value="<?php echo $linha['descricao'] ?>"><?php echo $linha['descricao'] ?></option>";
                <?php } ?>

            </select>
        </div>
        <div class="input-field">
            <label for="description" class="label">Description</label>
            <textarea required name="descricao" id="description" class="input-text"><?php echo $produto['descricao'] ?></textarea>
        </div>
        <div class="actions-form">
            <a href="products.php" class="action back">Back</a>
            <input class="btn-submit btn-action" type="submit" value="Save Product" />
        </div>

    </form>
</main>
<!-- Main Content -->

<!-- Footer -->
<footer>
    <div class="footer-image">
        <img src="images/go-jumpers.png" width="119" height="26" alt="Go Jumpers" />
    </div>
    <div class="email-content">
        <span>go@jumpers.com.br</span>
    </div>
</footer>
<!-- Footer -->
</body>

</html>