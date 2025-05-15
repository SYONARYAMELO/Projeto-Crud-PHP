<?php require 'conexao.php'; ?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario- Visualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-md">
            <a href="#" class="navbar-brand">CRUD PHP ESTRUTURAL</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];

                                $select = 'SELECT * FROM usuarios WHERE id = :id';
                                $stmt = $con->prepare($select);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();

                                if ($stmt->rowCount() > 0) {
                                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                            ?>

                                    <div class="mb-3">
                                        <label>Nome</label>
                                        <p class="form-control">
                                            <?= htmlspecialchars($usuario['nome']); ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <p class="form-control">
                                            <?= htmlspecialchars($usuario['email']); ?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Data nascimento</label>
                                        <p class="form-control">
                                            <?= date('d/m/Y', strtotime(htmlspecialchars($usuario['data_nascimento']))); ?>
                                        </p>
                                    </div>
                            <?php
                                } else {
                                    echo "<h5>Usuario não encontrado</h5>";
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>