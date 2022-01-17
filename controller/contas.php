<?php
require_once'../model/Contas.php';

if ($_POST) {
    if (
        isset($_POST["saldo"]) && isset($_POST["tipo_conta"]) && isset($_POST["instituicao_financeira"])
        && !empty($_POST["saldo"]) && !empty($_POST["tipo_conta"]) && !empty($_POST["instituicao_financeira"])
    ) {

        $saldo = filter_input(INPUT_POST, "saldo");
        $tipo_conta = filter_input(INPUT_POST, "tipo_conta", FILTER_SANITIZE_NUMBER_INT);
        $instituicao_financeira = filter_input(INPUT_POST, "instituicao_financeira", FILTER_SANITIZE_STRING);

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarContas = new Contas();
            $resposta = $editarContas->editarContas($id, $saldo, $tipo_conta, $instituicao_financeira);
            if($resposta = 1) header('location: /DesafioPubFuturePHP/index.php?pagina=contas');
            else header('location: /DesafioPubFuturePHP/index.php?pagina=contas&id=' . $id);
        } else {
            $adicionarContas = new Contas();
            $resposta = $adicionarContas->adicionarContas($saldo, $tipo_conta, $instituicao_financeira);
            if($resposta = 1) header('location: /DesafioPubFuturePHP/index.php?pagina=contas');
            else header('location: index.php?pagina=contas');
        }
    }else{
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);

        if($acao === "excluir"){
            $buscarContas = new Contas();
            $resposta = $buscarContas->excluirContas($id);
            header('location: /DesafioPubFuturePHP/index.php?pagina=contas');
        }
    }
}

