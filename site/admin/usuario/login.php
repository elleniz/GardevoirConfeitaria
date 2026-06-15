<?php
include '../header.php';
include_once "../database/db.class.php";

$db = new db('usuario');
$success = '';
$actionError = '';
$errors = [];
$data = '';

if (!empty($_POST)) {

    $data = (object) $_POST;
    // var_dump($_POST);
    //exit;
    try {

        if (empty($_POST['login'])) {
            $errors[] = "<li>O login é obrigatória</li>";
        }

        if (empty($_POST['senha'])) {
            $errors[] = "<li>A senha é obrigatória</li>";
        }

       if (empty($errors)) {

        //  adm fixo
        if ($_POST['login'] === 'admin' && $_POST['senha'] === '123') {

            $_SESSION['usuario_id'] = 0;
            $_SESSION['usuario_nome'] = 'Administrador';
            $_SESSION['usuario_login'] = 'admin';

            redirect('/GardevoirConfeitaria/indexadmin.html');
            exit;
        }

        $usuario = $db->findBy('login', $_POST['login']);

            //var_dump($usuario);
            //exit;

            if ($usuario && password_verify($_POST['senha'], $usuario->senha)) {
                $_SESSION['usuario_id'] = $usuario->id;
                $_SESSION['usuario_nome'] = $usuario->nome;
                $_SESSION['usuario_login'] = $usuario->login;

                $success = "Usuário logado com sucesso!";

                redirect('/GardevoirConfeitaria/index.html');
            } else {
                $actionError = "Login ou senha inválidos!, por favor tente novamente.";
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
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <?php actionMessage($success, $actionError) ?>
        <?php showValidationError($errors) ?>
        <div class="card-form">
            <form action="login.php" method="post">

                <h3 class="titulo mb-4"
                    style="font-weight: 700; font-family: 'Inter', sans-serif; color:#000000; padding-top:40px;">
                    <span style="color: #8F2738;">Bem vindo</span> de volta!
                </h3>

                <div class="form-group mb-3">
                    <label for="login">Login</label>
                    <input type="text"
                        name="login"
                        class="form-control"
                        placeholder="e-mail ou login"
                        value="<?php echo getFormValue($data, 'login'); ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="senha">Senha</label>
                    <input type="password"
                        name="senha"
                        class="form-control"
                        placeholder="insira sua senha"
                        value="<?php echo getFormValue($data, 'senha'); ?>">
                </div>

                <button type="submit" class="enviar-contato btn w-100 mt-4">
                    Acessar conta
                </button>

                <div class="text-center mt-3">
                    <p class="mb-1">Não tem uma conta?</p>
                    <a href="./UsuarioForm.php" style="color: #8F2738;">Crie aqui!</a>
                </div>
                <div class="text-center mt-3 text-muted">
                    <p style="font-size: 10px">Ao continuar, você concorda com nossa <span style="color: #661647;">Política de Privacidade<br> e Cookies e Termos e condições.</span></p>
                </div>
                </div>

    </form>
</div>
</body>

<?php
include '../footer.php';
?>