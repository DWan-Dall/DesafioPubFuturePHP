<?php

require_once __DIR__ . '/../model/Receitas.php';
require_once __DIR__ . '/../model/Contas.php';

try {
    $receita = new Receitas();
    $receita = $receita->listarReceitas();

    $conta = new Contas();

    $var = '';
    $date1 = '';
    $date2 = '';

    $sql = "SELECT * FROM receitas WHERE descricao LIKE '%{$var}%'";

    $sql = "SELECT * FROM receitas WHERE nome LIKE '%{$var}%'";

    $sql = "SELECT * FROM receitas WHERE data_recebimento AND data_recebimento_esperado BETWEEN '$date1' AND  '$date2'";

    $sql = "SELECT * FROM receitas WHERE tipo_receita LIKE '%{$var}%'";



} catch (Exception $e) {
    die($e->getMessage());

}
?>
<div class="row">
    <div class="col-sm-12 border border-secondary">
        <div class="row">
            <div class="col-sm-10">
                &nbsp;
            </div>
        </div>
        <table class="table table-striped" id="table_id">
            <h3>RECEITAS CADASTRADAS</h3>
            <thead>
            <tr>
                <th scope="col" class="col-2">Nome</th>
                <th scope="col" class="col-2">Valor</th>
                <th scope="col">Data Recebimento</th>
                <th scope="col">Recebimento Esperado</th>
                <th scope="col" class="col-2">Descrição</th>
                <th scope="col">Conta</th>
                <th scope="col" class="col-2">Tipo de Receita</th>
                <th scope="col">Ações</th>
            </tr>
            <tr>
                <th><input type="text" id="txtColuna1" class="col-lg-13"/></th>
                <th></th>
                <th><input type="text" id="txtColuna3" class="col-lg-12"/></th>
                <th><input type="text" id="txtColuna4" class="col-lg-12"/></th>
                <th></th>
                <th><input type="text" id="txtColuna6" class="col-lg-12"/></th>
                <th><input type="text" id="txtColuna7"/></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Receitas $receitas */
            foreach ($receita as $receitas) {
                $id = $receitas->getConta();
                $nomeConta = $conta->carregarContas($id);
                $valores = number_format($receitas->getValor(), 2, ",", ".");

                $dataRecebimento = $receitas->getData_recebimento();
                $dataRecebimento = new DateTime($dataRecebimento);
                $dataRecebimento = $dataRecebimento->format('d/m/Y');

                $dataRecebimentoEsperado = $receitas->getData_recebimento_esperado();
                $dataRecebimentoEsperado = new DateTime($dataRecebimentoEsperado);
                $dataRecebimentoEsperado = $dataRecebimentoEsperado->format('d/m/Y');
                ?>
                <tr>
                    <td><?php echo $receitas->getNome(); ?></td>
                    <td class="valor-calculado">R$ <?php echo $valores; ?></td>
                    <td><?php echo $dataRecebimento; ?></td>
                    <td><?php echo $dataRecebimentoEsperado; ?></td>
                    <td><?php echo $receitas->getDescricao() ?></td>
                    <td><?php echo $nomeConta->getInstituicao_financeira() ?></td>
                    <td><?php echo $receitas->getTipo_receita() ?></td>
                    <td class="col-lg-2">
                        <a href="index.php?pagina=cadastrarReceita&id=<?php echo $receitas->getId(); ?>&ver=1" style="text-decoration:none">
                            <button type="button" class="btn btn-info btn-sm" title="Visualizar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </a>
                        <a href="index.php?pagina=cadastrarReceita&id=<?php echo $receitas->getId(); ?>">
                            <button type="button" class="btn btn-warning btn-sm" title="Editar">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-id="<?php echo $receitas->getId(); ?>" title="Excluir">
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
<!--                    <th>Total</th>-->
<!--                    <td>--><?php //echo $total; ?><!--</td>-->
                </tr>

            </tfoot>
        </table>
    </div>
    <div class="m-3">
        <a class="btn btn-success" href="index.php?pagina=cadastrarReceita">
            <i class="fa fa-plus-circle"></i> Cadastrar
        </a>
    </div>
</div>
<script>
    $(function () {
        $('.btn-danger').on('click', function () {
            if (confirm('Deseja realmente excluir essa receita?')) {
                var id = $(this).data('id');
                document.location = 'controller/receitas.php?id=' + id + '&acao=excluir';
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