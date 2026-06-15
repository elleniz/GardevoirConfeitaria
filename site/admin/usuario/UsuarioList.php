<?php
include '../header.php';
include './autenticacao.php';

include_once "../database/db.class.php";

$db = new db('usuario');

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

if (!empty($_POST)) {
    // var_dump($_POST);
    //exit;
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}

?>
 <title><?= $titulo ?? 'Gardevoir Administração' ?></title>
 <header class="fixed-top">
    <!--FONTES--> <link rel="preconnect" href="https://fonts.googleapis.com"> <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Jacques+Francois&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!--CSS nao funciona--> <link rel="stylesheet" href="/GardevoirConfeitaria/css/contato.css">
     <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">        
        <img src="/GardevoirConfeitaria/img/logo.png" alt="logo" style="width: 230px; height: 100px; object-fit: cover; margin-left: 200px" class="logo-navbar">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ">
            <li class="nav-item navbar-text">
                 <a class="nav-link" href="/GardevoirConfeitaria/site/admin/pedido/PedidoList.php">Lista de Pedidos</a>
            </li>

            <li class="nav-item navbar-text">
                <a class="nav-link" href="/GardevoirConfeitaria/site/admin/avaliacao/AvaliacaoList.php">Lista de Avaliações</a>
            </li>

            <li class="nav-item navbar-text">
                <a class="nav-link" href="/GardevoirConfeitaria/site/admin/curso/CursoList.php">Lista de Cursos</a>
            </li>

            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/site/admin/usuario/UsuarioList.php">Lista de Usuários</a>
            </li>
            <li class="nav-item navbar-text">
              <a class="nav-link" href="/GardevoirConfeitaria/site/admin/usuario/Login.php">Login</a>
            </li>
          </ul>
        </div>
      </nav>
    </nav>
  </header>

<div class="container py-5">

    <div class="text-center mb-4">
        <h2 class="titulo"
            style="font-weight:700; font-family:'Inter', sans-serif; color:#000;">
            <span style="color:#8F2738;">Lista</span> de usuários
        </h2>

        <p class="text-muted">
            Área administrativa - usuários cadastrados
        </p>
    </div>

    <div class="card-form p-4">

        <form action="UsuarioList.php" method="post">

            <div class="row align-items-end">

                <div class="col-md-3 mb-3">
                    <label>Pesquisar por</label>

                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="telefone">Telefone</option>
                        <option value="email">Email</option>
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

                    <a href="./UsuarioForm.php"
                       class="btn"
                       style="background:#661647; color:white;">
                        Novo Usuário
                    </a>

                </div>

            </div>

        </form>

        <div class="table-responsive mt-4">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th colspan="2" class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($dados as $item) {
                        echo "
                        <tr>

                            <td>$item->id</td>

                            <td>$item->nome</td>

                            <td>$item->telefone</td>

                            <td>$item->email</td>

                            <td>
                                <a class='btn'
                                   style='background:#eda200; color:black;'
                                   href='./UsuarioForm.php?id=$item->id'>
                                    Editar
                                </a>
                            </td>

                            <td>
                                <a class='btn'
                                   style='background:#8F2738; color:white;'
                                   onclick='return confirm(\"Deseja excluir este usuário?\")'
                                   href='./UsuarioList.php?id=$item->id'>
                                    Excluir
                                </a>
                            </td>

                        </tr>";
                    }
                    ?>

                </tbody>

            </table>

        </div>

    </div>

</div>



<?php
include '../footer.php';
?>