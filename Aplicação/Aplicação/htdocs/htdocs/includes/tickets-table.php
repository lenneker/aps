<?php
include("../config/variables/connection.php");
$userid = $_SESSION["userid"];

$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$totalQuery = "SELECT COUNT(*) as total FROM tickets WHERE status = 'Aberto' AND user_id = ?";
$totalStmt = $mysqli->prepare($totalQuery);
$totalStmt->bind_param("s", $userid);
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalTickets = $totalRow['total'];
$totalPages = ceil($totalTickets / $limit);

$ticketsQuery = "SELECT id, description, open_date, category 
                 FROM tickets 
                 WHERE user_id = ? AND status IN ('Aberto', 'Em Análise')
                 ORDER BY id DESC 
                 LIMIT ? OFFSET ?";

$stmt = $mysqli->prepare($ticketsQuery);
$stmt->bind_param("sii", $userid, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Erro na consulta: " . $mysqli->error);
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

    .w-1 {
        width: 10% !important;
        text-align: center !important;
    }

    .w-2 {
        width: 65% !important;
    }

    .w-3 {
        width: 10% !important;
    }

    .w-4 {
        width: 15% !important;
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
<h4 class="h4">Denúncias pendentes sob sua solicitação:</h4>
    <table class="table table-striped table-hover col-sm-12" style="border-collapse: separate; border-spacing: 0;">
        <thead class="table">
            <tr>
                <th class="brl w-1" scope="col">ID</th>
                <th class="hide-description w-2" scope="col">Descrição</th>
                <th class="w-3" scope="col">Dt. Cad.:</th>
                <th class="brr w-4" scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($query_data = $result->fetch_assoc()) {
                $open_date = new DateTime($query_data["open_date"]);
                $formatted_open_date = $open_date->format('d/m/Y');

                echo "<tr class='ticket-row' onclick=\"window.location='../pages/ticket-info.php?id=" . $query_data["id"] . "'\">
                        <td class='w-1'>#" . $query_data["id"] . "</td>
                        <td class='w-2 hide-description'>" . $query_data["description"] . "</td>
                        <td class='w-3'>" . $formatted_open_date . "</td>
                        <td class='w-4'>" . $query_data["category"] . "</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <hr>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="<?php if ($page > 1) echo '?page=' . ($page - 1); ?>">&lt;</a>
            </li>

            <?php
            if ($page == 1) {
                for ($i = 1; $i <= min(3, $totalPages); $i++) {
                    echo '<li class="page-item' . ($page == $i ? ' active' : '') . '">
                            <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                          </li>';
                }
            } elseif ($page == $totalPages) {
                for ($i = max($totalPages - 2, 1); $i <= $totalPages; $i++) {
                    echo '<li class="page-item' . ($page == $i ? ' active' : '') . '">
                            <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                          </li>';
                }
            } else {
                $range = 1;
                for ($i = max(1, $page - $range); $i <= min($totalPages, $page + $range); $i++) {
                    echo '<li class="page-item' . ($page == $i ? ' active' : '') . '">
                            <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                          </li>';
                }
            }
            ?>

            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                <a class="page-link" href="<?php if ($page < $totalPages) echo '?page=' . ($page + 1); ?>">&gt;</a>
            </li>
        </ul>
    </nav>
</div>
