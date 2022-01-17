<?php
require_once'../model/Despesas.php';

if ($_POST) {
    if (
        isset($_POST["nome"]) && isset($_POST["valor"]) && isset($_POST["data_pagamento"])
        && isset($_POST["data_pagamento_esperado"]) && isset($_POST["conta"]) && isset($_POST["tipo_despesa"])
        && !empty($_POST["nome"]) && !empty($_POST["valor"]) && !empty($_POST["data_pagamento"])
        && !empty($_POST["data_pagamento_esperado"]) && !empty($_POST["conta"]) && !empty($_POST["tipo_despesa"])
    ) {

        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
        $valor = filter_input(INPUT_POST, "valor");
        $data_pagamento = filter_input(INPUT_POST, "data_pagamento",FILTER_SANITIZE_STRING);
        $data_pagamento_esperado = filter_input(INPUT_POST, "data_pagamento_esperado", FILTER_SANITIZE_STRING);
        $conta = filter_input(INPUT_POST, "conta", FILTER_SANITIZE_STRING);
        $tipo_despesa = filter_input(INPUT_POST, "tipo_despesa", FILTER_SANITIZE_STRING);

        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

            $editarDespesas = new Despesas();
            $resposta = $editarDespesas->editarDespesas($id, $nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa);
            if($resposta = 1) header('location: /DesafioPubFuturePHP/index.php?pagina=despesas');
            else header('location: /DesafioPubFuturePHP/index.php?pagina=despesas&id=' . $id);
        } else {
            $adicionarDespesas = new Despesas();
            $resposta = $adicionarDespesas->adicionarDespesas($nome, $valor, $data_pagamento, $data_pagamento_esperado, $conta, $tipo_despesa);
            if($resposta = 1) header('location: /DesafioPubFuturePHP/index.php?pagina=despesas');
            else header('location: /DesafioPubFuturePHP/index.php?pagina=despesas');
        }
    }else{
        echo "Campos obrigatórios não preenchidos!!!";
    }
} elseif ($_GET) {
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["acao"]) && !empty($_GET["acao"])) {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $acao = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);

        if($acao === "excluir"){
            $buscarDespesas = new Despesas();
            $resposta = $buscarDespesas->excluirDespesas($id);
            header('location: /DesafioPubFuturePHP/index.php?pagina=despesas');
        }
    }
}