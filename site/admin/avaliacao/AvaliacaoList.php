<?php
include '../header.php';
include '../usuario/autenticacao.php';
include_once "../database/db.class.php";

$db = new db('avaliacao');

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    $dados = $db->search($_POST)    ;
} else {
    $dados = $db->all();
}

?>

<div class="container py-5">

<div class="text-center mb-4">
    <h2 class="titulo"
        style="font-weight:700; font-family:'Inter', sans-serif; color:#000;">
        <span style="color:#8F2738;">Avaliações</span> de clientes
    </h2>

    <p class="text-muted">
        Área administrativa - avaliações
    </p>
</div>

<div class="card-form p-4">

    <form action="AvaliacaoList.php" method="post">

        <div class="row align-items-end">

            <div class="col-md-3 mb-3">
                <label>Pesquisar por</label>
                <select name="tipo" class="form-select">
                    <option value="item_avaliado">Item_avaliado</option>
                    <option value="tipo_avaliacao">Tipo avaliação</option>
                    <option value="descricao_avaliacao">Descrição avaliação</option>
                    <option value="nota_pedido">Nota pedido</option>
                </select>
            </div>

            <div class="col-md-5 mb-3">
                <label>Pesquisar</label>
                <input type="text"
                       name="valor"
                       class="form-control"
                       placeholder="Digite sua pesquisa">
            </div>

            <div class="col-md-4 mb-3">

                <button type="submit"
                        class="btn" style="background: #eda200; color: black">
                    Buscar
                </button>

                <a href="./AvaliacaoForm.php"
                   class="btn"
                   style="background:#661647; color:white;">
                    Cadastrar Avaliação
                </a>

            </div>

        </div>

    </form>

    <div class="table-responsive mt-4">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do cliente</th>
                    <th>Item avaliado</th>
                    <th>Tipo de avaliação</th>
                    <th>Descrição da avaliação</th>
                    <th>Nota</th>

                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php
                foreach ($dados as $item) {
                    echo "
                    <tr>
                        <td>$item->id</td>
                        <td>$item->nome_cliente</td>
                        <td>$item->item_avaliado</td>
                        <td>$item->tipo_avaliacao</td>
                        <td>$item->descricao_avaliacao</td>
                        <td>$item->nota_pedido</td>

                        <td>
                            <a class='btn' style='background: #eda200'
                               href='./AvaliacaoForm.php?id=$item->id'>
                               Editar
                            </a>
                        </td>

                        <td>
                            <a class='btn' style= 'background: #8F2738; color: white;'
                               onclick='return confirm(\"Deseja excluir este curso?\")'
                               href='./AvaliacaoList.php?id=$item->id'>
                               Excluir
                            </a>
                        </td>
                    </tr>";
                }
                ?>


            </tbody>

        </table>
        <div class="text-center mt-3">
            <a href="/GardevoirConfeitaria/index.html" style="color:#8F2738;">
                Voltar para a tela principal
            </a>
                </div>
    </div>

</div>

</div>




<?php
include '../footer.php';
?>