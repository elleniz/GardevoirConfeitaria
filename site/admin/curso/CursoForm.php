<?php
require_once '../header.php';
include '../usuario/autenticacao.php';
require_once "../database/db.class.php";

$db = new db('curso');
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

        if (empty($_POST['titulo_curso'])) {
            $errors[] = "<li>O título do curso é um campo obrigatório</li>";
        }

        if (empty($_POST['descricao_curso'])) {
            $errors[] = "<li>A descrição do curso é um campo obrigatória</li>";
        }

        if (empty($_POST['valor_curso'])) {
            $errors[] = "<li>O valor do curso é um campo obrigatório</li>";
        }

        if (empty($_POST['duracao_curso'])) {
            $errors[] = "<li>A Duração do curso é um campo obrigatória</li>";
        }

        if (empty($_POST['professor_curso'])) {
            $errors[] = "<li>O professor do curso é um campo obrigatório</li>";
        }

        if (empty($errors)) {
            if (empty($_POST['id'])) {

                $dado = [
                    'titulo_curso' => $_POST['titulo_curso'],
                    'descricao_curso' => $_POST['descricao_curso'],
                    'valor_curso' => $_POST['valor_curso'],
                    'link_curso' => $_POST['link_curso'],
                    'duracao_curso' => $_POST['duracao_curso'],
                    'professor_curso' => $_POST['professor_curso']
                ];

                $db->store($dado);

                $success = "Curso cadastrado com sucesso!";

            } else {

                $db->update($_POST);

                $success = "Curso atualizado com sucesso!";
            }
            redirect('./CursoList.php');
        }
    } catch (PDOException $e) {
        $actionError = $e->getMessage();
    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }
}
?>

<div class="container min-vh-100 d-flex justify-content-center align-items-center py-5">

    <div class="col-md-8 col-lg-6">

        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>

        <div class="card shadow-sm border-0 p-4" style="border-radius: 20px; background: #fff;">

            <form action="CursoForm.php" method="post">

                <h3 class="mb-2" style="font-weight:700; font-family:'Inter', sans-serif;">
                    <span style="color:#8F2738;">Cadastre</span> um curso
                </h3>

                <p class="text-muted mb-4">
                    Área administrativa - cadastro de cursos
                </p>

                <input type="hidden"
                       name="id"
                       value="<?php echo getFormValue($data, 'id'); ?>">

                <div class="mb-3">
                    <label class="form-label">Título do curso</label>
                    <input type="text"
                           name="titulo_curso"
                           class="form-control"
                           placeholder="Ex: Bolo de Chocolate para Iniciantes"
                           value="<?php echo getFormValue($data, 'titulo_curso'); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição do curso</label>
                    <textarea name="descricao_curso"
                              class="form-control"
                              rows="5"
                              placeholder="Digite as informações essenciais sobre o curso"><?php echo getFormValue($data, 'descricao_curso'); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Professor do curso</label>
                    <input type="text"
                           name="professor_curso"
                           class="form-control"
                           placeholder="Nome completo do professor"
                           value="<?php echo getFormValue($data, 'professor_curso'); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Duração do curso</label>
                    <input type="time"
                           name="duracao_curso"
                           class="form-control"
                           value="<?php echo getFormValue($data, 'duracao_curso'); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor do curso (R$)</label>
                    <input type="text"
                           name="valor_curso"
                           class="form-control"
                           placeholder="Ex: 99,90"
                           value="<?php echo getFormValue($data, 'valor_curso'); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Link do curso</label>
                    <input type="text"
                           name="link_curso"
                           class="form-control"
                           placeholder="Insira o link da página do curso"
                           value="<?php echo getFormValue($data, 'link_curso'); ?>">
                </div>

                <button type="submit"
                        class="btn w-100 mt-3"
                        style="background:#8F2738; color:white; border-radius:12px;">
                    Salvar Curso
                </button>

                <div class="text-center mt-3">
                    <a href="./CursoList.php" style="color:#8F2738;">
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