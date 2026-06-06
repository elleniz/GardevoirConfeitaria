<?php

include_once './database/db.class.php';

$conn = new db("usuario");

$dados = [
    'nome' => "Jackson Five 2",
    'telefone' => "84 9888-55522",
    'email' => "lordjackson@gmail.com",
    'login' => "jackson",
    'senha' => password_hash("123", PASSWORD_DEFAULT)
];

$conn->store($dados);

echo "Inserido com sucesso!";