<?php

require_once __DIR__ . '/../model/Receitas.php';
require_once __DIR__ . '/../model/Despesas.php';
require_once __DIR__ . '/../model/Contas.php';

try {
    $receita = new Receitas();
    $receita = $receita->listarReceitas();

    $despesa = new Despesas();
    $despesa = $despesa->listarDespesas();

    $conta = new Contas();
    $conta = $conta->listarContas();

} catch (Exception $e) {
    die($e->getMessage());
}
?>
<!--<div class="row">-->
<!--    <div class="col-md-3">-->
<!--        <div class="form-group">-->
<!--          <label for="tipo_conta"></label>-->
<!--            <select name="tipo_conta" class="form-select" aria-label="Default select example" --><?//=$disabled ?><!-- required>-->
<!--                <option value="0">Selecione...</option>-->
<!--                <option value="1">RECEITAS</option>-->
<!--                <option value="2">DESPESAS</option>-->
<!--                <option value="3">AMBAS</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <div class="form-group">-->
<!--            <label for="tipo_conta"></label>-->
<!--            <select name="tipo_conta" class="form-select" aria-label="Default select example" --><?//=$disabled ?><!-- required>-->
<!--                <option value="0">Selecione...</option>-->
<!--                <option value="1">Data Pagamento</option>-->
<!--                <option value="2">Data Pagamento Esperado</option>-->
<!--                <option value="3">Tipo de Despesa</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <div class="form-group">-->
<!--      <label for=""></label>-->
<!--            <input type="text" class="form-control" name="nome" id="nome" value="" required>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md">-->
<!--        <div class="form-group">-->
<!--            <button type="submit" class="btn btn-outline-info">-->
<!--                <i class="fa fa-search"></i>-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="row">
    <div class="col-sm-4 border border-secondary" style="margin: 0 5px">
        <table class="table table-striped" id="table_id">
            <thead>
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Receita</th>
                <th scope="col">Valor</th>
                <th scope="col">Ver</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Receitas $receitas */
            foreach ($receita as $receitas) {
                $data = $receitas->getData_recebimento_esperado();
                $data = new DateTime($data);
                $dataFormat = $data->format('d/m/Y');
                ?>
                <tr>
                    <td><?php echo $dataFormat; ?></td>
                    <td><?php echo $receitas->getNome(); ?></td>
                    <td>R$ <?php echo number_format($receitas->getValor(), 2, ",", ".") ?></td>
                    <td>
                        <a href="index.php?pagina=cadastrarReceita&id=<?php echo $receitas->getId(); ?>&ver=1">
                            <button type="button" class="btn btn-outline-secondary btn-sm" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-4 border border-secondary" style="margin: 0 30px">
        <table class="table table-striped" id="table_id">
            <thead>
            <tr>
                <th scope="col">Data</th>
                <th scope="col">Despesa</th>
                <th scope="col">Valor</th>
                <th scope="col">Ver</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Despesas $despesas */
            foreach ($despesa as $despesas) {
                $data = $despesas->getData_pagamento_esperado();
                $data = new DateTime($data);
                $dataFormat = $data->format('d/m/Y');
                ?>
                <tr>
                    <td><?php echo $dataFormat; ?></td>
                    <td><?php echo $despesas->getNome(); ?></td>
                    <td>R$ <?php echo number_format($despesas->getValor(), 2, ",", ".") ?></td>
                    <td>
                        <a href="index.php?pagina=cadastrarDespesa&id=<?php echo $despesas->getId(); ?>&ver=1">
                            <button type="button" class="btn btn-outline-secondary btn-sm" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-3 border border-secondary">
        <table class="table table-striped" id="table_id">
            <thead>
            <tr>
                <th scope="col">Conta</th>
                <th scope="col">Saldo</th>
                <th scope="col">Ver</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Contas $contas */
            foreach ($conta as $contas) {
                ?>
                <tr>
                    <td><?php echo $contas->getInstituicao_financeira(); ?></td>
                    <td>R$ <?php echo number_format($contas->getSaldo(), 2, ",", ".") ?></td>
                    <td>
                        <a href="index.php?pagina=cadastrarConta&id=<?php echo $contas->getId(); ?>&ver=1">
                            <button type="button" class="btn btn-outline-secondary btn-sm" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

