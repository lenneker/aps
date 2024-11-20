<?php

include("../config/variables/connection.php");

$limit = 5;

$ticketsQuery = "SELECT t.id, t.open_date, t.category, t.priority, u.first_name, u.last_name
                 FROM tickets t
                 JOIN users u ON t.user_id = u.id
                 WHERE t.status IN ('Aberto', 'Em Análise')
                 ORDER BY 
                    CASE 
                        WHEN t.priority = 'Urgente' THEN 1 
                        ELSE 2 
                    END, 
                    t.id DESC
                 LIMIT ?";

$stmt = $mysqli->prepare($ticketsQuery);
$stmt->bind_param("i", $limit);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    thead th {
        height: 50px !important;
        text-align: start !important;
        background-color: #AC1B2F !important;
        color: white !important;
    }

    .brl {
        border-radius: 5px 0 0 0 !important;
    }

    .brr {
        border-radius: 0 5px 0 0 !important;
    }

    td {
        text-align: start !important;
    }

    .table {
        box-shadow: 0 7px 13px rgba(0, 0, 0, 0.1);
    }

    .w-1,
    .w-2,
    .w-3,
    .w-4,
    .w-5 {

        width: 25% !important;
        text-align: center !important;

    }

    h4 {
        font-weight: bold !important;
        color: #AC1B2F !important;
        margin-bottom: 20px;
    }

    @media (max-width: 767px) {
        .hide-description {
            display: none !important;
        }

        thead th {
            width: 33% !important;
            text-align: center !important;
        }

        td {
            width: 33% !important;
            text-align: center !important;
        }

        .h4 {
            justify-content: center !important;
            text-align: center !important;
        }
    }

    @media (max-width: 475px) {
        .hide-description {
            display: none !important;
        }

        thead th {
            width: 33% !important;
            text-align: center !important;
        }

        td {
            width: 33% !important;
            text-align: center !important;
        }

        .h4 {
            justify-content: center !important;
            text-align: center !important;
        }
    }
</style>

<div class="container p-5">
    <h4 class="h4">Denúncias recentes:</h4>
    <table class="table table-striped table-hover col-sm-12" style="border-collapse: separate; border-spacing: 0;">
        <thead class="table">
            <tr>
                <th class="brl w-1" scope="col">ID</th>
                <th class="w-2" scope="col">Usuário</th> <!-- Coluna para o nome do usuário -->
                <th class="w-3" scope="col">Dt. Cad.:</th>
                <th class=" brr w-4" scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibindo os dados das denúncias
            while ($query_data = $result->fetch_assoc()) {
                $open_date = new DateTime($query_data["open_date"]);
                $formatted_open_date = $open_date->format('d/m/Y');

                // Combina o nome e sobrenome
                $user_name = $query_data["first_name"] . ' ' . $query_data["last_name"];

                echo "<tr class='ticket-row' onclick=\"window.location='../../admin-area/admin-ticket-info.php?id=" . $query_data["id"] . "'\">
                        <td class='w-1'>#" . $query_data["id"] . "</td>
                        <td class='w-2'>" . $user_name . "</td> <!-- Nome do usuário -->
                        <td class='w-3'>" . $formatted_open_date . "</td>
                        <td class='w-4'>" . $query_data["category"] . "</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <hr>
</div>