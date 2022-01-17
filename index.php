<?php
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : '';

switch ($pagina) {
    case '':
    case 'home':
        $arquivoPagina = 'home.php';
        break;
    case 'receitas':
        $arquivoPagina = 'listarReceita.php';
        break;
    case 'cadastrarReceita':
        $arquivoPagina = 'cadastrarReceita.php';
        break;
    case 'despesas':
        $arquivoPagina = 'listarDespesa.php';
        break;
    case 'cadastrarDespesa':
        $arquivoPagina = 'cadastrarDespesa.php';
        break;
    case 'contas':
        $arquivoPagina = 'listarConta.php';
        break;
    case 'cadastrarConta':
        $arquivoPagina = 'cadastrarConta.php';
        break;
    case 'transfereConta':
        $arquivoPagina = 'transfereConta.php';
        break;
    case 'transferir':
        $arquivoPagina = 'completaTransfere.php';
        break;
    default:
        $arquivoPagina = 'erro.php';
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/icons-money.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <title>Controle-se</title>
    <style>
        .marginal {
            margin-top: 180px;
        }
        a {
            text-decoration:none;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color:#5a5a5a;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/DesafioPubFuturePHP/">
                <img src="images/logo.JPG">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-4 mb-md-4">
                    <li class="nav-item me-auto">
                        <a class="nav-link <?php echo $arquivoPagina == 'home.php' ? 'active' : ''; ?>" aria-current="page" href="/DesafioPubFuturePHP/">
                            <i class="fa fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $arquivoPagina == 'listarReceita.php' ? 'active' : ''; ?>" href="/DesafioPubFuturePHP/?pagina=receitas">
                            <i class="fa fa-plus-square"></i> Receitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $arquivoPagina == 'listarDespesa.php' ? 'active' : ''; ?>" href="/DesafioPubFuturePHP/?pagina=despesas">
                            <i class="fa fa-minus-square"></i> Despesas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo in_array($pagina, ['conta', 'contas']) ? 'active' : ''; ?>" href="/DesafioPubFuturePHP/?pagina=contas">
                            <i class="fa fa-credit-card-alt"></i> Contas
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="marginal">
    <div class="container marketing">
        <hr class="featurette-divider">

        <?php
        require 'pages/' . $arquivoPagina;
        ?>

        <hr class="featurette-divider">
    </div>

    <!-- FOOTER -->
    <footer class="container">
        <p class="text-center">&copy; 2022 - Daiane Wan-Dall</p>
    </footer>
</main>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>