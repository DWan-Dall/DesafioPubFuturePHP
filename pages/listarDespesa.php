<?php

require_once __DIR__ . '/../model/Despesas.php';
require_once __DIR__ . '/../model/Contas.php';

try {
    $despesa = new Despesas();
    $despesa = $despesa->listarDespesas();

    $conta = new Contas();

} catch (Exception $e) {
    die($e->getMessage());
}
?>
<script src="../js/jquery-3.6.0.min.js"></script>
<div class="row">
    <div class="col-sm-12 border border-secondary">
        <div class="row">
            <div class="col-sm-10">
                &nbsp;
            </div>
        </div>

        <table class="table table-striped" id="table_id">
            <h3>DESPESAS CADASTRADAS</h3>
            <thead>
            <tr>
                <th scope="col" class="col-2">Nome</th>
                <th scope="col" class="col-2">Valor</th>
                <th scope="col">Data Pagamento</th>
                <th scope="col">Pagamento Esperado</th>
                <th scope="col">Conta</th>
                <th scope="col" class="col-2">Tipo de Despesa</th>
                <th scope="col">Ações</th>
            </tr>
            <tr>
                <th><input type="text" id="txtColuna1"/></th>
                <th></th>
                <th><input type="text" id="txtColuna3"/></th>
                <th><input type="text" id="txtColuna4"/></th>
                <th></th>
                <th><input type="text" id="txtColuna6"/></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Despesas $despesas */
            foreach ($despesa as $despesas) {
                $id = $despesas->getConta();
                $nomeConta = $conta->carregarContas($id);

                $dataPagamento = $despesas->getData_pagamento();
                $dataPagamento = new DateTime($dataPagamento);
                $dataPagamento = $dataPagamento->format('d/m/Y');

                $dataPagamentoEsperado = $despesas->getData_pagamento_esperado();
                $dataPagamentoEsperado = new DateTime($dataPagamentoEsperado);
                $dataPagamentoEsperado = $dataPagamentoEsperado->format('d/m/Y');
                ?>
                <tr>
                    <td><?php echo $despesas->getNome(); ?></td>
                    <td>R$ <?php echo number_format($despesas->getValor(), 2, ",", ".") ?></td>
                    <td><?php echo $dataPagamento; ?></td>
                    <td><?php echo $dataPagamentoEsperado; ?></td>
                    <td><?php echo $nomeConta->getInstituicao_financeira() ?></td>
                    <td><?php echo $despesas->getTipo_despesa() ?></td>
                    <td class="col-lg-2">
                        <a href="index.php?pagina=cadastrarDespesa&id=<?php echo $despesas->getId(); ?>&ver=1">
                            <button type="button" class="btn btn-info btn-sm" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                        <a href="index.php?pagina=cadastrarDespesa&id=<?php echo $despesas->getId(); ?>">
                            <button type="button" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $despesas->getId(); ?>" title="Excluir">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
<!--                <th>Total</th>-->
<!--                <td>--><?php //echo $total; ?><!--</td>-->
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="m-3">
        <a class="btn btn-success" href="index.php?pagina=cadastrarDespesa">
            <i class="fa fa-plus-circle"></i> Cadastrar
        </a>
    </div>
</div>
<script>
    $(function () {
        $('.btn-danger').on('click', function () {
            if (confirm('Deseja realmente excluir essa despesa?')) {
                var id = $(this).data('id');
                document.location = 'controller/despesas.php?id=' + id + '&acao=excluir';
            }
        })
    })
    $(function(){
        $("#table_id input").keyup(function(){
            var index = $(this).parent().index();
            var nth = "#table_id td:nth-child("+(index+1).toString()+")";
            var valor = $(this).val().toUpperCase();
            $("#table_id tbody tr").show();
            $(nth).each(function(){
                if($(this).text().toUpperCase().indexOf(valor) < 0){
                    $(this).parent().hide();
                }
            });
        });

        $("#table_id input").blur(function(){
            $(this).val("");
        });
    });
</script>