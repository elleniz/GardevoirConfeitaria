<?php
include '../header.php';
include_once "../database/db.class.php";

$db = new db('pedido');
$data = new stdClass();
$success = '';
$actionError = '';
$errors = [];

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

if (!empty($_POST)) {
    $data = (object) $_POST;

    try {

        if (empty($_POST['nome_cliente'])) {
            $errors[] = "<li>O nome do cliente é um campo obrigatório</li>";
        }

        if (empty($_POST['telefone_cliente'])) {
            $errors[] = "<li>O telefone do cliente é um campo obrigatório</li>";
        }

        if (empty($_POST['descricao_pedido'])) {
            $errors[] = "<li>O Descrição do pedido é um campo obrigatório</li>";
        }

        if (empty($_POST['quantidade_produto'])) {
            $errors[] = "<li>A quantidade do produto é um campo obrigatório</li>";
        }

        if (empty($_POST['data_hora_retirada'])) {
            $errors[] = "<li>A data da retirada é um campo obrigatório</li>";
        }
        
        if (empty($_POST['valor_total'])) {
            $errors[] = "<li>O valor total do pedido é um campo obrigatória</li>";
        }

        if (empty($_POST['forma_pagamento'])) {
            $errors[] = "<li>A forma de pagamento do pedido é um campo obrigatória</li>";
        }

        if (empty($_POST['status'])) {
            $errors[] = "<li>Lembre-se de atualizar o status do pedido</li>";
        }

        if (empty($errors)) {
            if (empty($_POST['id'])) {

                $dado = [
                    'nome_cliente' => $_POST['nome_cliente'],
                    'telefone_cliente' => $_POST['telefone_cliente'],
                    'descricao_pedido' => $_POST['descricao_pedido'],
                    'quantidade_produto' => $_POST['quantidade_produto'],
                    'data_hora_retirada' => $_POST['data_hora_retirada'],
                    'valor_total' => $_POST['valor_total'],
                    'forma_pagamento' => $_POST['forma_pagamento'],
                    'status' => $_POST['status'],
                ];

                $db->store($dado);

                $success = "Pedido cadastrado! Lembre-se de atualizar o status do pedido regularmente.";

            } else {

                $db->update($_POST);

                $success = "Pedido atualizado com sucesso!";
            }
            redirect('./PedidoList.php');
        }
    } catch (PDOException $e) {
        $actionError = $e->getMessage();
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}

?>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">

    <div class="col-md-8 col-lg-6">

        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>

        <div class="card-form">

            <form action="PedidoForm.php" method="post">

                <h3 class="titulo mb-4"
                    style="font-weight:700; font-family:'Inter', sans-serif; color:#000;">
                    <span style="color:#8F2738;">Cadastre</span> um pedido
                </h3>
                <p class="text-muted align-center">
                    Área administrativa - cadastro de pedidos
                </p>

                <input type="hidden"
                       name="id"
                       value="<?php echo getFormValue($data, 'id'); ?>">

                <div class="form-group mb-3">
                    <label>Nome do cliente</label>
                    <input type="text"
                           name="nome_cliente"
                           class="form-control"
                           placeholder="Nome fornecido pelo WhatsApp"
                           value="<?php echo getFormValue($data, 'nome_cliente'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Telefone do cliente</label>
                    <input type="number"
                        name="telefone_cliente"
                        class="form-control"
                        placeholder="Telefone do cliente (WhatsApp) Ex: 49984294089"
                        value="<?php echo getFormValue($data, 'telefone_cliente'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Descrição do pedido</label>
                    <input type="text"
                           name="descricao_pedido"
                           class="form-control"
                           placeholder="Ex: Brigadeiro de chocolate branco"
                           value="<?php echo getFormValue($data, 'descricao_pedido'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Quantidade do produto</label>
                    <input type="number"
                           name="quantidade_produto"
                           class="form-control"
                           value="<?php echo getFormValue($data, 'quantidade_produto'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Data / hora da retirada </label>
                    <input type="datetime-local"
                           name="data_hora_retirada"
                           class="form-control"
                           placeholder="Data solicitada pelo cliente"
                           value="<?php echo getFormValue($data, 'data_hora_retirada'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Valor total do pedido </label>
                    <input type="number"
                           name="valor_total"
                           class="form-control"
                           placeholder="149.60"
                           value="<?php echo getFormValue($data, 'valor_total'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Forma de pagamento</label>
                    <input type="text"
                           name="forma_pagamento"
                           class="form-control"
                           placeholder="Ex: Cartão de débito"
                           value="<?php echo getFormValue($data, 'forma_pagamento'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Status do pedido</label>

                    <select name="status" class="form-select">

                        <option value="">Selecione o status</option>

                        <option value="Aguardando pagamento"
                            <?php echo getFormValue($data, 'status') == 'Aguardando pagamento' ? 'selected' : ''; ?>>
                            Aguardando pagamento
                        </option>

                        <option value="Pago"
                            <?php echo getFormValue($data, 'status') == 'Pago' ? 'selected' : ''; ?>>
                            Pago
                        </option>

                        <option value="Em produção"
                            <?php echo getFormValue($data, 'status') == 'Em produção' ? 'selected' : ''; ?>>
                            Em produção
                        </option>

                        <option value="Pronto para retirada"
                            <?php echo getFormValue($data, 'status') == 'Pronto para retirada' ? 'selected' : ''; ?>>
                            Pronto para retirada
                        </option>

                        <option value="Entregue"
                            <?php echo getFormValue($data, 'status') == 'Entregue' ? 'selected' : ''; ?>>
                            Entregue
                        </option>

                        <option value="Cancelado"
                            <?php echo getFormValue($data, 'status') == 'Cancelado' ? 'selected' : ''; ?>>
                            Cancelado
                        </option>

                </select>
            </div>

                <button type="submit" class="enviar-contato btn w-100 mt-4">
                    Salvar Pedido
                </button>

                <div class="text-center mt-3">
                    <a href="./PedidoList.php" style="color:#8F2738;">
                        Voltar para a listagem
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

<?php
include '../footer.php';
?>