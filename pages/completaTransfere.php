<?php

require_once __DIR__ . '/../model/Contas.php';

try {

    $contas = new Contas();

    $conta_1 = $_POST['id'];
    $valor = $_POST['valor'];
    $conta_2 = $_POST['id2'];

    if (isset($_POST['valor'])) {
        $valor = $_POST['valor'];
    } else {
        $valor = 0;
    }

    $saldo = $contas->carregarContas($conta_1);
    $saldo = $saldo->getSaldo();
    $mensagem = null;

    if ($conta_1 != null AND $conta_2 != null) {
        if ($conta_1 === $conta_2) {
            $mensagem = "Não é possível efetuar a transferência para mesma conta. 
                    Escolha uma conta diferente para prosseguir.";
        } if ($saldo < $valor) {
            $mensagem = "Não há saldo suficiente para efetuar a transferência.";
        } else {
            $saldo = $saldo - $valor;
//            $conta_1
//                ->setSaldo($saldo)
//                ->editaConta();
            $mensagem = "Transferência no valor de R$ " . $valor . " executada com sucesso.";
        }
    }

} catch (Exception $e) {
    die($e->getMessage());
}

?>

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">

<div class="col-md-4">
    <div class="form-group">
        <span><?php echo $mensagem; ?></span>
    </div>
</div>

<a title='voltar' onclick='voltar()' class='btn btn-danger'>
    <i class='fa fa-undo'></i> Voltar
</a>

<script>
    function voltar() {
        window.history.back();
    }
</script>