<?php
session_start();
require 'conexao.php';

if (isset($_POST['create_usuario'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, data_nascimento,senha) values (:nome, :email, :data_nascimento, :senha)";

    $stmt = $con->prepare($sql);

    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':data_nascimento' => $data_nascimento,
        ':senha' => $senha
    ]);

    header("Location: index.php?msg=usuario_criado");
    exit();
}


if (isset($_POST['update_usuario'])) {
    $id = $_POST['usuario_id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($id && $nome && $email && $data_nascimento) {
        if (!empty($senha)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, data_nascimento = :data_nascimento, senha = :senha WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':senha', $senha_hash);
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, data_nascimento = :data_nascimento WHERE id = :id";
            $stmt = $con->prepare($sql);
        }

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Usuário atualizado com sucesso!";
        } else {
            $_SESSION['message'] = "Erro ao atualizar usuário.";
        }
    } else {
        $_SESSION['message'] = "Por favor, preencha todos os campos obrigatórios.";
    }

    header('Location: index.php');
    exit();
}

// Excluir usuário via POST
if (isset($_POST['delete-usuario'])) {
    $id = (int) $_POST['delete-usuario'];  // cast para garantir que é número

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Usuário excluído com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao excluir usuário.";
    }

    header("Location: index.php");
    exit();
}
