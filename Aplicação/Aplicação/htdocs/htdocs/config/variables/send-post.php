<?php
function sendPostRequest($url, $data) {
    // Converte o array de dados para JSON
    $content = json_encode($data);

    // Inicializa a sessão cURL
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    // Executa a requisição e armazena a resposta
    curl_exec($curl);

    // Verifica o status da requisição
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    // Retorna true se o status for 200 ou 201, indicando sucesso; caso contrário, retorna false
    return $status == 200 || $status == 201;
}
?>
