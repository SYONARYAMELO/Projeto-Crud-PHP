<?php

$host = 'localhost';
$db = 'canalti';
$user = 'root';
$pass = '';

try {
    //criando a conexão
    $con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    //configura o pdo para lança exceções em caso de erros
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo"Conectado";

} catch (PDOException $e) {
    //em caso de erro na conexão, exibe uma mensagem
    echo 'Erro: ' . $e->getMessage();

    die(); //encerra aconexão
}
