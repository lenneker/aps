<?php

// Inclui o arquivo de conexão com o banco de dados
include("../config/variables/connection.php");

$attendant = $_SESSION['username'];

// Função para formatar números de telefone
function formatPhoneNumber($phone)
{
    // Usa uma expressão regular para formatar o número de telefone
    return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
}

// Função para formatar a data
function formatDate($date)
{
    // Formata a data para o formato 'd/m/Y à H:i'
    return date('d/m/Y \à\s H:i', strtotime($date));
}

// Verifica se o parâmetro 'id' está presente na URL e é um número válido
if (!empty($_GET["id"]) && is_numeric($_GET["id"]) && intval($_GET["id"]) > 0) {
    // Converte o id para um inteiro
    $id = intval($_GET["id"]);

    // Prepara a consulta SQL para selecionar o ticket correspondente
    $stmt = $mysqli->prepare("
        SELECT t.*, u.first_name, u.last_name, u.email
        FROM tickets t
        JOIN users u ON t.user_id = u.id
        WHERE t.id = ?
    ");
    // Liga o id à consulta
    $stmt->bind_param("i", $id);

    // Executa a consulta
    if (!$stmt->execute()) {
        // Redireciona para a página inicial se ocorrer um erro
        header("Location: ../admin-home.php");
        exit();
    }

    // Obtém o resultado da consulta
    $result = $stmt->get_result();

    // Se os dados do usuário forem encontrados
    if ($user_data = $result->fetch_assoc()) {
        // Formata a data de abertura
        $open_date = formatDate($user_data['open_date']);
        // Formata a data de fechamento ou define como 'Não disponível'
        $close_date = $user_data['close_date'] ? formatDate($user_data['close_date']) : 'Não disponível';
        // Formata o número de telefone
        $phone = formatPhoneNumber($user_data['phone']);
        // Obtém outros dados do ticket
        $category = $user_data['category'];
        $description = htmlspecialchars($user_data['description']); // Escapa caracteres especiais
        $status = $user_data['status'];
        $location = $user_data['location'];
        $priority = $user_data['priority'];
        $resolution_justification = htmlspecialchars($user_data['resolution_justification']);
        $user_email = $user_data['email'];
        $logradouro = $user_data['logradouro'];
        $bairro = $user_data['bairro'];
        $cidade = $user_data['cidade'];
        $estado = $user_data['estado'];
        $full_name = htmlspecialchars($user_data['first_name'] . ' ' . $user_data['last_name']); 

    } else {
        // Se não encontrar o usuário, redireciona para a página inicial
        header("Location: ../admin-home.php");
        exit();
    }
} else {
    // Se o id não for válido, redireciona para a página inicial
    header("Location: ../admin-home.php");
    exit();
}

// Mapeia as obras para o seu nome correspondente
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

// Define o rótulo de status com base na localização
$statusLabel = isset($obras[$location]) ? $obras[$location] : 'Desconhecida';

// Valida o status
$valid_status = ['Aberto', 'Em Análise', 'Concluído'];
// Garante que o status seja válido, caso contrário, define como 'Aberto'
$status = in_array($status, $valid_status) ? $status : 'Aberto';

?>

<!-- Bootstrap CSS -->
<link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/index.css">
<!-- Bootstrap Icons CSS -->
<link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container pt-5 text-end">
    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary btn-md" disabled>
            <i class="bi bi-arrow-return-left"></i> Responder
        </button>

        <button type="button" class="btn btn-danger btn-md" onclick="window.history.back()">
            <i class="bi bi-box-arrow-in-left"></i> Voltar
        </button>
    </div>
</div>

<div class="container d-flex justify-content-center align-items-center pt-5 pb-5">
    <form action="../../config/variables/save-edit.php" class="row g-3 needs-validation" method="POST">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-floating mb-3 col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="#<?php echo $id ?>" readonly>
            <label for="floatingInput">N° da denúncia</label>
        </div>

        <div class="form-floating bg-danger mb-3 col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <select name="status" class="form-control shadow" id="floatingInput" required>
                <option value="<?php echo htmlspecialchars($status); ?>" selected>
                    <?php echo htmlspecialchars($status); ?>
                </option>
                <!-- Opções dinâmicas -->
                <?php if ($status !== 'Aberto'): ?>
                    <option value="Aberto">Abrir chamado</option>
                <?php endif; ?>
                <?php if ($status !== 'Em Análise'): ?>
                    <option value="Em Análise">Em Análise</option>
                <?php endif; ?>
                <?php if ($status !== 'Concluído'): ?>
                    <option value="Concluído">Fechar Denúncia</option>
                <?php endif; ?>
            </select>

            <label for="floatingInput">Status</label>
        </div>

        <div class="form-floating mb-3 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $full_name; ?>" readonly>
            <label for="floatingInput">Usuário</label>
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
            <input type="text" name="category" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $category ?>" readonly>
            <label for="floatingInput">Categoria</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($location); ?>" readonly>
            <label for="floatingInput">CEP</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($logradouro); ?>" readonly>
            <label for="floatingInput">Logradouro</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($bairro); ?>" readonly>
            <label for="floatingInput">Bairro</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($estado); ?>" readonly>
            <label for="floatingInput">Estado</label>
        </div>

        <div class="form-floating mb-3 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="obra" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo htmlspecialchars($logradouro); ?>" readonly>
            <label for="floatingInput">Logradouro</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="text" name="priority" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $priority; ?>" readonly>
            <label for="floatingInput">Prioridade</label>
        </div>

        <div class="form-floating mb-3 col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 p-1">
            <input type="tel" name="" class="form-control shadow" id="floatingInput" placeholder=""
                value="<?php echo $phone ?>" readonly>
            <label for="floatingInput">Telefone</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <textarea name="description" class="form-control shadow" id="floatingTextarea" placeholder=""
                style="height: 200px" readonly><?php echo $description; ?></textarea>
            <label for="floatingTextarea">Descrição do chamado</label>
        </div>

        <div class="form-floating bg-sucess mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <textarea name="resolution_justification" class="form-control shadow" id="floatingTextarea" placeholder=""
                style="height: 200px"><?php echo $resolution_justification; ?></textarea>
            <label for="floatingTextarea">Justificativa de resolução</label>
        </div>

        <div class="container text-end pt-3">
            <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
        </div>
    </form>
</div>