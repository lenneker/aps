<?php
session_start();
include_once('../variables/connection.php');

// Função para enviar a requisição POST
function sendPostRequest($url, $data) {
    $content = json_encode($data);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    return $status == 200 || $status == 201;
}

$attendant = $_SESSION['username'];

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    $resolution_justification = $_POST['resolution_justification'];

    // Atualiza o ticket no banco de dados
    $stmt = $mysqli->prepare("UPDATE tickets SET status=?, resolution_justification=?, attendant=? WHERE id=?");
    $stmt->bind_param("sssi", $status, $resolution_justification, $attendant, $id);
    $stmt->execute();
    $stmt->close();

    $url = "http://localhost:8080/admin-area/includes/receive-post.php"; // Altere conforme necessário

    if ($status === 'Concluído' || $status === 'Em Análise') {
        $email_stmt = $mysqli->prepare("SELECT u.email, t.description FROM tickets t JOIN users u ON t.user_id = u.id WHERE t.id = ?");
        $email_stmt->bind_param("i", $id);
        $email_stmt->execute();
        $email_stmt->bind_result($user_email, $description);
        $email_stmt->fetch();
        $email_stmt->close();

        if (!empty($user_email)) {
            $data = [
                "user_email" => $user_email,
                "ticket_id" => $id,
                "description" => $description,
                "resolution_justification" => $resolution_justification,
                "attendant" => $attendant,
                "status" => $status
            ];

            $success = sendPostRequest($url, $data);

            if (!$success) {
                echo "Erro ao enviar notificação";
            }
        }
    }

    header('Location: ../../admin-area/admin-home.php');
    exit();
}

header("Location: admin-panel.php");
exit();
?>
