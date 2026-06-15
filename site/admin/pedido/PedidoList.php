<?php
include '../header.php';
include_once "../database/db.class.php";
include '../usuario/autenticacao.php';
$db = new db('pedido');

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>

<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="titulo"
            style="font-weight:700; font-family:'Inter', sans-serif; color:#000;">
            <span style="color:#8F2738;">Lista</span> de pedidos
        </h2>

        <p class="text-muted">
            Área administrativa - pedidos
        </p>
    </div>

    <div class="card-form p-4">

        <form action="PedidoList.php" method="post">

            <div class="row align-items-end">

                <div class="col-md-3 mb-3">
                    <label>Pesquisar por</label>

                    <select name="tipo" class="form-select">
                        <option value="nome_cliente">Cliente</option>
                        <option value="descricao_pedido">Itens do pedido</option>
                        <option value="data_hora_retirada">Data da retirada</option>
                        <option value="forma_pagamento">Forma de pagamento</option>
                        <option value="status">Status</option>
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
                            class="btn"
                            style="background:#eda200; color:black;">
                        Buscar
                    </button>

                    <a href="./PedidoForm.php"
                       class="btn"
                       style="background:#661647; color:white;">
                        Novo Pedido
                    </a>

                </div>

            </div>

        </form>

        <div class="table-responsive mt-4">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Telefone</th>
                        <th>Itens do pedido</th>
                        <th>Qtd.</th>
                        <th>Retirada</th>
                        <th>Pagamento</th>
                        <th>Status</th>
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

                            <td>$item->telefone_cliente</td>

                            <td>$item->descricao_pedido</td>

                            <td>$item->quantidade_produto</td>

                            <td>$item->data_hora_retirada</td>

                            <td>$item->forma_pagamento</td>

                            <td>$item->status</td>

                            <td>
                                <a class='btn'
                                   style='background:#eda200; color:black;'
                                   href='./PedidoForm.php?id=$item->id'>
                                    Editar
                                </a>
                            </td>

                            <td>
                                <a class='btn'
                                   style='background:#8F2738; color:white;'
                                   onclick='return confirm(\"Deseja excluir este pedido?\")'
                                   href='./PedidoList.php?id=$item->id'>
                                    Excluir
                                </a>
                            </td>

                        </tr>";
                    }
                    ?>

                </tbody>

            </table>

            <div class="text-center mt-3">
                <a href="/GardevoirConfeitaria/index.html" 
                   style="color:#8F2738;">
                    Voltar para a tela principal
                </a>
            </div>

        </div>

    </div>

</div>

<?php
include '../footer.php';
?>