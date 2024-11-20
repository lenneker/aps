<?php

include('../includes/protect.php');
$userid = $_SESSION["userid"];

?>

<!doctype html>
<html lang="pt-br">

<head>
    <title>Denúncias | Prefeitura de São Paulo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/index.css">
    <!-- Bootstrap Icons CSS -->
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body>

    <div class="d-flex flex-column wrapper">

        <!-- Include Navbar -->
        <?php include '../includes/navbar.php'; ?>

        <main class="flex-fill">

            <!-- Include Form -->
            <?php include '../includes/ticket-form.php'; ?>

        </main>

        <!-- Include Footer -->
        <?php include '../includes/footer.php'; ?>

    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>