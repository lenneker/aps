<?php

$userid = $_SESSION["username"];

include('mailer-create-user.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $first_name = $_POST['firstName'];
    $middle_name = $_POST['middleName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $passwordNH = $_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query_createUser = "INSERT INTO users (first_name, middle_name, last_name, email, password, created_by) VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$password', '$userid')";

    include_once('../config/variables/connection.php');

    if ($mysqli->query($query_createUser) === TRUE) {
        echo "Usuário criado com sucesso!";

        $user_name = $first_name . ' ' . $last_name;

        if (!empty($email)) {
            sendCreatedEmail($email, $passwordNH, $user_name);
        }

    } else {
        echo "Erro ao criar usuário: " . $mysqli->error;
    }
}
?>

<div class="container p-5">
    <form action="" method="post">
        <div class="row">
            <hr>
            <div class="form-floating mb-3 p-1 col-12 col-sm-4">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Nome" required>
                <label for="firstName">Nome</label>
            </div>

            <div class="form-floating mb-3 p-1 col-12 col-sm-4">
                <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Sobrenome">
                <label for="middleName">Sobrenome</label>
            </div>

            <div class="form-floating mb-3 p-1 col-12 col-sm-4">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Último nome" required>
                <label for="lastName">Último nome</label>
            </div>

            <div class="form-floating p-1 col-12 col-sm-6">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                <label for="email">E-mail</label>
            </div>

            <div class="form-floating p-1 col-12 col-sm-6">
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                <label for="password">Senha</label>
            </div>
        </div>

        <hr>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">