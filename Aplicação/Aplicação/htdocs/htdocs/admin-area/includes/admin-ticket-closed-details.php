<?php

include '../config/variables/connection.php';


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
    $stmt = $mysqli->prepare("SELECT * FROM tickets WHERE id = ? AND user_id = ?");
    $stmt->bind_param("is", $id, $_SESSION['userid']);
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
    } else {
        header("Location: ../pages/home.php");
        exit();
    }
} else {
    header("Location: ../pages/home.php");
    exit();
}

$obras = [
    'UNITA' => 'Escritório',
    'P013C' => '9 de Julho',
    'P048C' => 'Amador Bueno',
    'P052C' => 'Atlântico Meridional',
    'U002C' => 'Bella Aliança',
    'P020C' => 'Campo Belo',
    'U001C' => 'Carvalho da Matta',
    'P009C' => 'Casa Genebra',
    'P008C' => 'Centro',
    'P017C' => 'Conceito Taboão',
    'P007C' => 'Dom Bosco',
    'P049C' => 'Elza Guimarães',
    'P016C' => 'Itaquera III',
    'P045C' => 'Marka - Tucuruvi',
    'P021C' => 'Miraus - Alvorada',
    'P018C' => 'Penha III',
    'U050C' => 'Praça Santa Helena',
    'P051C' => 'REV 3 - Vila Matilde',
    'P012C' => 'Santa Cruz',
    'P047C' => 'Santo Amaro',
    'P019C' => 'Vila dos Remédios',
    'P014C' => 'Vila Ema II',
];

$statusLabel = isset($obras[$location]) ? $obras[$location] : 'Desconhecida';
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
                value="Não atribuído" readonly>
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
                value="<?php echo htmlspecialchars($statusLabel); ?>" readonly>
            <label for="floatingInput">Obra</label>
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
    
