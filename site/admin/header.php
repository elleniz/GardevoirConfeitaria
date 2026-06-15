<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$BASE_URL = "/GardevoirConfeitaria";

function redirect($page, $time = 1500)
{
    echo "<script>
        setTimeout(() => window.location.href = '$page', $time);
    </script>";
}

function actionMessage($success = "", $error = "")
{
    if (!empty($success)) {
        echo "<div class='alert alert-success' role='alert'><strong>$success</strong></div>";
    }

    if (!empty($error)) {
        echo "<div class='alert alert-danger' role='alert'><strong>$error</strong></div>";
    }
}

function showValidationError($errors = [])
{
    if (!empty($errors)) {
        echo "<div class='alert alert-danger' role='alert'><ul><strong>Erros nos campos:</strong>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    }
}

function getFormValue($data, $field = '')
{
    return isset($data->$field) ? $data->$field : '';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $titulo ?? 'Gardevoir Administração' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/style.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/navbar.css">
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/footer.css">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Inter:wght@100..900&family=Jacques+Francois&family=Poppins:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link rel="preconnect" href="https://fonts.googleapis.com"> <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Jacques+Francois&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!--CSS nao funciona--> <link rel="stylesheet" href="/GardevoirConfeitaria/css/contato.css">

    <!-- JS -->
    <script src="<?= $BASE_URL ?>./javascript/menu-navegacao.js" defer></script>
    <script src="<?= $BASE_URL ?>./javascript/footer.js" defer></script>
</head>

<body>

  <header class="fixed-top">
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
  </header>

<div class="container">
    <div class="row">