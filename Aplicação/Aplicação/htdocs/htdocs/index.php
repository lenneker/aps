<?php

include('config/variables/connection.php');

$loginError = false;

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {
    
        $email = $mysqli->real_escape_string($email);
        
        $queryCode = "SELECT first_name, last_name, id, user_type, password FROM users WHERE email = '$email'";

        $sqlQuery = $mysqli->query($queryCode);

        if ($sqlQuery && $sqlQuery->num_rows == 1) {
            $user_data = $sqlQuery->fetch_assoc();

            if (password_verify($password, $user_data['password'])) {
                
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['username'] = $user_data['first_name'] . ' ' . $user_data['last_name'];
                $_SESSION['userid'] = $user_data['id'];
                $_SESSION['user_type'] = $user_data['user_type'];

                if (strtolower(trim($user_data['user_type'])) == 'admin') {
                    header('Location: admin-area/admin-home.php');
                } else {
                    header('Location: pages/home.php');
                }
                exit();
            } else {
              
                $loginError = true;
            }
        } else {
            
            $loginError = true;
        }
    }
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/login.css" />

    <title>Denúncias | Prefeitura de São Paulo</title>

    <style>
        
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
            text-align: center;
            opacity: 0; 
            transition: opacity 0.3s ease; 
            height: 20px;
        }

        .error-message.show {
            opacity: 1;
            
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="" method="POST" class="sign-in-form">
                    <h2 class="title">Faça login para usar nossos serviços</h2>

                    <div class="input-field">
                        <i class="bi bi-person-circle"></i>
                        <input type="text" name="email" placeholder="e-mail" required />
                    </div>

                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" name="password" placeholder="senha" required />
                    </div>

                    <span class="error-message" id="loginError">Credenciais inválidas! Tente novamente.</span>

                    <input type="submit" value="Login" class="btn solid" />
                </form>

                <form action="#" class="sign-up-form">
                    <h2 class="title">Perdeu sua senha?</h2>
                    <p class="txt"></p>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Perdeu suas credenciais?</h3>
                    <p>
                        Entre em contato conosco para recuperar suas credenciais de forma fácil e rápida.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Saiba mais
                    </button>
                </div>
                <img src="" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Recordou suas credenciais?</h3>
                    <p>Realize o login para acessar nossos serviços e aproveitar ao máximo suas funcionalidades.</p>
                    <button class="btn transparent" id="sign-in-btn">
                        Login
                    </button>
                </div>

                <img src="" class="image" alt="" /> 
            </div>
        </div>
    </div>

    <script>
        <?php if ($loginError) : ?>
            document.addEventListener("DOMContentLoaded", function() {
                const errorMessage = document.getElementById("loginError");
                errorMessage.classList.add("show"); 
                setTimeout(() => {
                    errorMessage.classList.remove("show"); 
                }, 3000);
            });
        <?php endif; ?>
    </script>

    <script src="assets/js/erro-login-alert.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>
