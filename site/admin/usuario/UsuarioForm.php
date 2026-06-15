<?php
include '../header.php';
include './autenticacao.php';
include_once '../database/db.class.php';

$db = new db('usuario');
$success = '';
$actionError = '';
$errors = [];
$data = '';

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}

if (!empty($_POST)) {

    $data = (object) $_POST;
    // var_dump($_POST);
    //exit;
    try {
    
        if (empty($_POST['nome'])) {
            $errors[] = "<li>O nome é obrigatório</li>";
        }

        if (empty($_POST['email'])) {
            $errors[] = "<li>O email é obrigatório</li>";
        }

        if (empty($_POST['senha'])) {
            $errors[] = "<li>A senha é obrigatório</li>";

            if (strlen($_POST['senha'] < 3)) {
                $errors[] = "<li>A senha deve ter no minimo 3 caracteres</li>";
            }
        }

        if (empty($errors)) {
            if (empty($_POST['id'])) {

                $dado = [
                    'nome' => $_POST['nome'],
                    'email' => $_POST['email'],
                    'telefone' => $_POST['telefone'] ? $_POST['telefone'] : "",
                    'login' => $_POST['login'],
                    'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
                ];

                $db->store($dado);

            $success = "Usuário cadastrado com sucesso! Redirecionando para o login...";
            redirect('./login.php');

            } else {

                $db->update($_POST);

                $success = "Usuario atualizado com sucesso!";
                redirect('./UsuarioList.php');

            }

        }

    } catch (PDOException $e) {
        $actionError = $e->getMessage();

    } catch (Exception $e) {
        $actionError = $e->getMessage();
    }

}


?>

<header class="fixed-top">
     <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">        
        <img src="/GardevoirConfeitaria/img/logo.png" alt="logo" style="width: 230px; height: 100px; object-fit: cover; margin-left: 200px" class="logo-navbar">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ">
            <li class="nav-item navbar-text active">
              <a class="nav-link" href="/GardevoirConfeitaria/index.html"style="color: #F0C260";>Início</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/paginas/produtos.html">Produtos</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/paginas/cursos.html">Cursos</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/paginas/localizacao.html">Localização</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/paginas/sobrenos.html">Sobre nós</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/paginas/contato.html">Contate-nos</a>
            </li>

            <li class="nav-item navbar-text">
                <a class="nav-link" href="/GardevoirConfeitaria/site/admin/usuario/login.php">Login</a>
              </li>
          </ul>
        </div>
      </nav>
    </nav>
  </header>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">

    <div class="col-md-8 col-lg-6">

        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>

        <div class="card-form">

            <form action="UsuarioForm.php" method="post">
                <input type="hidden"
                    name="id"
                    value="<?php echo getFormValue($data, 'id'); ?>">
                <h3 class="titulo mb-4"
                    style="font-weight:700; font-family:'Inter', sans-serif; color:#000;">
                    <span style="color:#8F2738;">Crie</span> sua conta
                </h3>

                <div class="form-group mb-3">
                    <label for="nome">Nome</label>
                    <input type="text"
                           name="nome"
                           class="form-control"
                           placeholder="ex: João da Silva"
                           value="<?php echo getFormValue($data, 'nome'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="email">E-mail</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="ex: joaodasilva@gardevoir.com"
                           value="<?php echo getFormValue($data, 'email'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="telefone">Telefone</label>
                    <input type="text"
                           name="telefone"
                           class="form-control"
                           placeholder="89999887766"
                           value="<?php echo getFormValue($data, 'telefone'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="login">Login</label>
                    <input type="text"
                           name="login"
                           class="form-control"
                           placeholder="escolha seu nome de usuário"
                           value="<?php echo getFormValue($data, 'login'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="senha">Senha</label>
                    <input type="password"
                           name="senha"
                           class="form-control"
                           placeholder="insira uma senha"
                           value="<?php echo getFormValue($data, 'senha'); ?>">
                </div>

                <button type="submit" class="enviar-contato btn w-100 mt-4">
                    Criar conta
                </button>

                <div class="text-center mt-3">
                    <p class="mb-1">Já tem uma conta?</p>
                    <a href="./login.php"style="color: #8F2738;">Faça login aqui</a>
                </div>

                <div class="text-center mt-3 text-muted">
                    <p style="font-size: 10px">Ao continuar, você concorda com nossa <span style="color: #661647;">Política de Privacidade<br> e Cookies e Termos e condições.</span></p>
                </div>

            </form>

        </div>

    </div>

</div>

<?php
include '../footer.php';
?>