<?php
require_once'../model/Receitas.php';

if ($_POST) {
    if (
        isset($_POST["nome"]) && isset($_POST["valor"]) && isset($_POST["data_recebimento"]) && isset($_POST["data_recebimento_esperado"])
        && isset($_POST["descricao"]) && isset($_POST["conta"]) && isset($_POST["tipo_receita"])
        && !empty($_POST["nome"]) && !empty($_POST["valor"]) && !empty($_POST["data_recebimento"]) && !empty($_POST["data_recebimento_esperado"])
        && !empty($_POST["descricao"]) && !empty($_POST["conta"]) && !empty($_POST["tipo_receita"])
    ) {

        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST, "valor");
        $data_recebimento = filter_input(INPUT_POST, "data_recebimento",FILTER_SANITIZE_STRING);
        $data_recebimento_esperado = filter_input(INPUT_POST, "data_recebimento_esperado", FILTER_SANITIZE_STRING);
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
        $conta = filter_input(INPUT_POST, "conta", FILTER_SANITIZE_STRING);
        $tipo_receita = filter_input(INPUT_POST, "tipo_receita", FILTER_SANITIZE_STRING);

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarReceitas = new Receitas();
            $resposta = $editarReceitas->editarReceitas($id, $nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita);
            if($resposta = 1) header('location: /DesafioPubFuturePHP/index.php?pagina=receitas');
            else header('location: /DesafioPubFuturePHP/index.php?pagina=receitas&id=' . $id);
        } else {
            $adicionarReceitas = new Receitas();
            $resposta = $adicionarReceitas->adicionarReceitas($nome, $valor, $data_recebimento, $data_recebimento_esperado, $descricao, $conta, $tipo_receita);
            if($resposta = 1) header('location: /DesafioPubFuturePHP/index.php?pagina=receitas');
            else header('location: /DesafioPubFuturePHP/index.php?pagina=receitas');
        }
    }else{
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);

        if($acao === "excluir"){
            $buscarReceitas = new Receitas();
            $resposta = $buscarReceitas->excluirReceitas($id);
            header('location: /DesafioPubFuturePHP/index.php?pagina=receitas');
        }
    }
}

