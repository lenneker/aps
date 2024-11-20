<?php

include '../config/variables/connection.php';

function formatCEP($cep)
{
    return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
}

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

    // Ensure the session variable is set
    if (!isset($_SESSION['userid'])) {
        header("Location: ../pages/home.php");
        exit();
    }

    $stmt = $mysqli->prepare("SELECT * FROM tickets WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $_SESSION['userid']); // Assuming user_id is an integer
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
        $attendant = $user_data['attendant'];
        $logradouro = $user_data['logradouro'];
        $bairro = $user_data['bairro'];
        $cidade = $user_data['cidade'];
        $estado = $user_data['estado'];
    } else {
        header("Location: ../pages/home.php");
        exit();
    }
} else {
    header("Location: ../pages/home.php");
    exit();
}

?>

<!-- Bootstrap CSS -->
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/index.css">
<!-- Bootstrap Icons CSS -->
<link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container d-flex justify-content-center align-items-center p-5">
    <form class="row g-3 needs-validation" method="POST">

        <div class="form-floating mb-3 col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="ticket_id" class="form-control shadow" id="floatingInputId" placeholder=""
                value="#<?php echo $id ?>" readonly>
            <label for="floatingInputId">N° de Protocolo</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="status" class="form-control shadow" id="floatingInputStatus" placeholder=""
                value="<?php echo $status ?>" readonly>
            <label for="floatingInputStatus">Status</label>
        </div>

        <div class="form-floating mb-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="attendant" class="form-control shadow" id="floatingInputAttendant" placeholder=""
                value="<?php echo $attendant ? htmlspecialchars($attendant) : 'Aguardando atribuição'; ?>" readonly>
            <label for="floatingInputAttendant">Atendente</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="open_date" class="form-control shadow" id="floatingInputOpenDate" placeholder=""
                value="<?php echo $open_date ?>" readonly>
            <label for="floatingInputOpenDate">Data de abertura</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="close_date" class="form-control shadow" id="floatingInputCloseDate" placeholder=""
                value="<?php echo $close_date ?>" readonly>
            <label for="floatingInputCloseDate">Data de conclusão</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="category" class="form-control shadow" id="floatingInputCategory" placeholder=""
                value="<?php echo $category ?>" readonly>
            <label for="floatingInputCategory">Categoria</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInputObra" placeholder=""
                value="<?php echo formatCEP(htmlspecialchars($location)); ?>" readonly>
            <label for="floatingInputObra">CEP</label>
        </div>


        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInputObra" placeholder=""
                value="<?php echo htmlspecialchars($logradouro); ?>" readonly>
            <label for="floatingInputObra">Logradouro</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInputObra" placeholder=""
                value="<?php echo htmlspecialchars($bairro); ?>" readonly>
            <label for="floatingInputObra">Bairro</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInputObra" placeholder=""
                value="<?php echo htmlspecialchars($cidade); ?>" readonly>
            <label for="floatingInputObra">Cidade</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInputObra" placeholder=""
                value="<?php echo htmlspecialchars($estado); ?>" readonly>
            <label for="floatingInputObra">Estado</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="priority" class="form-control shadow" id="floatingInputPriority" placeholder=""
                value="<?php echo $priority; ?>" readonly>
            <label for="floatingInputPriority">Prioridade</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="tel" name="phone" class="form-control shadow" id="floatingInputPhone" placeholder=""
                value="<?php echo $phone ?>" readonly>
            <label for="floatingInputPhone">Telefone</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-1">
            <textarea name="description" class="form-control shadow" placeholder="" id="floatingTextareaDescription"
                style="height: 200px" readonly><?php echo $description; ?></textarea>
            <label for="floatingTextareaDescription">Descrição do problema</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 p-1">
            <textarea name="response" class="form-control shadow" placeholder="" id="floatingTextareaResponse"
                style="height: 200px" readonly><?php echo $resolution_justification; ?></textarea>
            <label for="floatingTextareaResponse">Resposta do atendente</label>
        </div>

    </form>

</div>