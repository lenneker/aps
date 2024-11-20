<?php

require_once(__DIR__ . "/../../config/variables/connection.php");

function formatPhoneNumber($phone)
{
    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
}

function formatDate($date)
{
    return date('d/m/Y \à\s H:i', strtotime($date));
}

if (!empty($_GET["id"])) {
    $id = intval($_GET["id"]);
    // Removido o filtro pelo user_id
    $stmt = $mysqli->prepare("SELECT * FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user_data = $result->fetch_assoc()) {
        $open_date = formatDate($user_data['open_date']);
        $close_date = $user_data['close_date'] ? formatDate($user_data['close_date']) : 'Não disponível';
        $phone = formatPhoneNumber($user_data['phone']);
        $category = $user_data['category'];
        $description = htmlspecialchars($user_data['description']);
        $status = $user_data['status'];
        $location = $user_data['location'];
        $priority = $user_data['priority'];
        $resolution_justification = htmlspecialchars($user_data['resolution_justification']);
        $logradouro = $user_data['logradouro'];
        $bairro = $user_data['bairro'];
        $cidade = $user_data['cidade'];
        $estado = $user_data['estado'];
        $attendant = $user_data['attendant'];
    } else {
        header("Location: ../admin-home.php");
        exit();
    }
} else {
    header("Location: ../admin-home.php");
    exit();
}

?>

<!-- Bootstrap CSS -->
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/index.css">
<!-- Bootstrap Icons CSS -->
<link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container d-flex justify-content-center align-items-center pt-5 pb-5">
    <form class="row g-3 needs-validation" method="POST">

        <div class="form-floating mb-3 col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="#<?php echo $id ?>" readonly>
            <label for="floatingInput">Número do chamado</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $status ?>" readonly>
            <label for="floatingInput">Status</label>
        </div>

        <div class="form-floating mb-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $attendant ?>" readonly>
            <label for="floatingInput">Atendente</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $open_date ?>" readonly>
            <label for="floatingInput">Data de abertura</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $close_date ?>" readonly>
            <label for="floatingInput">Data de conclusão</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $category ?>" readonly>
            <label for="floatingInput">Categoria</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($location); ?>" readonly>
            <label for="floatingInput">CEP</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($logradouro); ?>" readonly>
            <label for="floatingInput">Logradouro</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($bairro); ?>" readonly>
            <label for="floatingInput">Bairro</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($cidade); ?>" readonly>
            <label for="floatingInput">Cidade</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($estado); ?>" readonly>
            <label for="floatingInput">Estado</label>
        </div>



        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $priority; ?>" readonly>
            <label for="floatingInput">Prioridade</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="tel" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $phone ?>" readonly>
            <label for="floatingInput">Telefone</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-1">
            <textarea name="description" class="form-control shadow" placeholder="" id="floatingTextarea2"
                style="height: 200px" readonly><?php echo $description; ?></textarea>
            <label for="floatingTextarea2">Descrição do problema</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-1">
            <textarea name="response" class="form-control shadow" placeholder="" id="floatingTextarea2"
                style="height: 200px" readonly><?php echo $resolution_justification; ?></textarea>
            <label for="floatingTextarea2">Resposta do atendente</label>
        </div>

    </form>

    </>
    
