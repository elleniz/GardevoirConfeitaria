<?php
include '../header.php';
include '../usuario/autenticacao.php';
include_once "../database/db.class.php";

$db = new db('avaliacao');
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
            $errors[] = "<li>O seu nome é um campo obrigatório.</li>";
        }

        if (empty($_POST['tipo_avaliacao'])) {
            $errors[] = "<li>Selecione o tipo de avaliação.</li>";
        }

        if (empty($_POST['descricao_avaliacao'])) {
            $errors[] = "<li>Descreva sua avaliação.</li>";
        }

        if (empty($_POST['nota_pedido'])) {
            $errors[] = "<li>Escolha uma nota.</li>";
        }

        if (empty($errors)) {
            if (empty($_POST['id'])) {

                $dado = [
                    'nome_cliente' => $_POST['nome_cliente'],
                    'item_avaliado' => $_POST['item_avaliado'],
                    'tipo_avaliacao' => $_POST['tipo_avaliacao'],
                    'descricao_avaliacao' => $_POST['descricao_avaliacao'],
                    'nota_pedido' => $_POST['nota_pedido'],
                ];

                $db->store($dado);

                $success = "Avaliação cadastrada com sucesso!";

            } else {

                $db->update($_POST);

                $success = "Avaliação atualizada com sucesso!";
            }

            redirect('./AvaliacaoList.php');
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

            <form action="AvaliacaoForm.php" method="post">

                <h3 class="titulo mb-4"
                    style="font-weight:700; font-family:'Inter', sans-serif; color:#000;">
                    <span style="color:#8F2738;">Cadastre</span> uma avaliação
                </h3>

                <p class="text-muted align-center">
                    Cadastro de avaliação
                </p>

                <input type="hidden"
                       name="id"
                       value="<?php echo getFormValue($data, 'id'); ?>">

                <div class="form-group mb-3">
                    <label>Seu nome</label>
                    <input type="text"
                           name="nome_cliente"
                           class="form-control"
                           placeholder="Ex: Paulo"
                           value="<?php echo getFormValue($data, 'nome_cliente'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Deseja avaliar um item específico?</label>
                    <input type="text"
                           name="item_avaliado"
                           class="form-control"
                           placeholder="Ex: macaron de baunilha"
                           value="<?php echo getFormValue($data, 'item_avaliado'); ?>">
                </div>

                <label>Tipo de avaliação</label>

                <select name="tipo_avaliacao" class="form-select">

                    <option value="">
                        Selecione o tipo de avaliação
                    </option>

                    <option value="Produto loja presencial"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'Produto loja presencial' ? 'selected' : ''; ?>>
                        Produto loja presencial
                    </option>

                    <option value="Produto pedido WhatsApp"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'Produto pedido WhatsApp' ? 'selected' : ''; ?>>
                        Produto pedido WhatsApp
                    </option>

                    <option value="Pacote casamento"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'Pacote casamento' ? 'selected' : ''; ?>>
                        Pacote casamento
                    </option>

                    <option value="Atendimento presencial"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'Atendimento presencial' ? 'selected' : ''; ?>>
                        Atendimento presencial
                    </option>

                    <option value="Atendimento WhatsApp"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'Atendimento WhatsApp' ? 'selected' : ''; ?>>
                        Atendimento WhatsApp
                    </option>

                    <option value="Estrutura do estabelecimento"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'Estrutura do estabelecimento' ? 'selected' : ''; ?>>
                        Estrutura do estabelecimento
                    </option>

                    <option value="cursos"
                        <?php echo getFormValue($data, 'tipo_avaliacao') == 'cursos' ? 'selected' : ''; ?>>
                        Cursos
                    </option>

                </select>

                <div class="form-group mb-3">
                    <label>Avaliação</label>
                    <textarea name="descricao_avaliacao"
                              class="form-control"
                              rows="5"
                              placeholder="Cite aqui os pontos positivos e negativos da sua experiência."><?php echo getFormValue($data, 'descricao_avaliacao'); ?></textarea>
                </div>

                <label>Nota</label>

                <select name="nota_pedido" class="form-select">

                    <option value="">
                        Que nota você daria para sua experiência Gardevoir
                    </option>

                    <option value="1" <?php echo getFormValue($data, 'nota_pedido') == '1' ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo getFormValue($data, 'nota_pedido') == '2' ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo getFormValue($data, 'nota_pedido') == '3' ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo getFormValue($data, 'nota_pedido') == '4' ? 'selected' : ''; ?>>4</option>
                    <option value="5" <?php echo getFormValue($data, 'nota_pedido') == '5' ? 'selected' : ''; ?>>5</option>

                </select>

                <button type="submit" class="enviar-contato btn w-100 mt-4">
                    Salvar Avaliação
                </button>

                <div class="text-center mt-3">
                    <a href="./AvaliacaoList.php" style="color:#8F2738;">
                        Voltar para a listagem
                    </a>
                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../footer.php'; ?>