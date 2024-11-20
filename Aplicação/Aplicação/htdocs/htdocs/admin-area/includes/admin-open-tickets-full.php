<?php
include("../config/variables/connection.php");

$limit = 5; // Limite de registros por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página atual
$offset = ($page - 1) * $limit; // Calcula o offset para a consulta

$search_id = isset($_GET['search_id']) ? $_GET['search_id'] : '';

// Consulta para obter o número total de tickets com ou sem filtro
$totalQuery = "SELECT COUNT(*) as total FROM tickets WHERE status = 'Aberto'";
if (!empty($search_id)) {
    $totalQuery .= " AND id = ?";
}

$totalStmt = $mysqli->prepare($totalQuery);
if (!empty($search_id)) {
    $totalStmt->bind_param("i", $search_id); // Passa o ID da pesquisa como parâmetro
}
$totalStmt->execute();
$totalResult = $totalStmt->get_result();
$totalRow = $totalResult->fetch_assoc();
$totalTickets = $totalRow['total'];
$totalPages = ceil($totalTickets / $limit);

// Consulta para obter os tickets, com LIMIT e OFFSET
$ticketsQuery = "SELECT t.id, t.open_date, t.category, t.priority, u.first_name, u.last_name
                 FROM tickets t
                 JOIN users u ON t.user_id = u.id
                 WHERE t.status IN ('Aberto', 'Em Análise')";

if (!empty($search_id)) {
    $ticketsQuery .= " AND t.id = ?";
}

$ticketsQuery .= " ORDER BY 
                    CASE 
                        WHEN t.priority = 'Urgente' THEN 1 
                        ELSE 2 
                    END, 
                    t.id DESC
                 LIMIT ? OFFSET ?";

$stmt = $mysqli->prepare($ticketsQuery);
if (!empty($search_id)) {
    $stmt->bind_param("iii", $search_id, $limit, $offset); // Passa ID de pesquisa, limite e offset
} else {
    $stmt->bind_param("ii", $limit, $offset); // Passa limite e offset
}
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Erro ao buscar os tickets.");
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
        width: 20% !important;
        text-align: center !important;
    }

    .urgent-ticket {
        background-color: #ff4d4d !important;
    }

    .urgent-ticket td {
        color: white !important;
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
    <nav class="navbar pb-3" style="background-color: transparent;">
        <div class="container-fluid" style="padding-right: 0;">
            <!-- Formulário de busca -->
            <form class="d-flex ms-auto" role="search" method="GET" action="">
                <input class="form-control me-2" type="search" name="search_id" placeholder="Buscar protocolo..."
                    aria-label="Search" value="<?php echo htmlspecialchars($search_id); ?>">
                <button class="btn" type="submit"
                    style="background-color: #AC1B2F; color: white; border-color: #AC1B2F;">Pesquisar</button>
            </form>
        </div>
    </nav>

    <h4 class="h4">Denúncias abertas:</h4>
    <table class="table table-striped table-hover col-sm-12" style="border-collapse: separate; border-spacing: 0;">
        <thead class="table">
            <tr>
                <th class="brl w-1" scope="col">ID</th>
                <th class="w-2" scope="col">Usuário</th> <!-- Coluna para o nome do usuário -->
                <th class="w-3" scope="col">Dt. Cad.:</th>
                <th class="brr w-4" scope="col">Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($query_data = $result->fetch_assoc()) {
                $open_date = new DateTime($query_data["open_date"]);
                $formatted_open_date = $open_date->format('d/m/Y');

                // Combina o nome e sobrenome
                $user_name = $query_data["first_name"] . ' ' . $query_data["last_name"];

                // Verifica se a prioridade é 'Urgente' e adiciona uma classe CSS especial
                $priority_class = ($query_data["priority"] == 'Urgente') ? 'urgent-ticket' : '';

                echo "<tr class='ticket-row $priority_class' onclick=\"window.location='../../admin-area/admin-ticket-info.php?id=" . $query_data["id"] . "'\">
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

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="<?php if ($page > 1) echo '?page=' . ($page - 1) . '&search_id=' . urlencode($search_id); ?>">&lt;</a>
            </li>

            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item' . ($page == $i ? ' active' : '') . '">
                        <a class="page-link" href="?page=' . $i . '&search_id=' . urlencode($search_id) . '">' . $i . '</a>
                      </li>';
            }
            ?>

            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                <a class="page-link" href="<?php if ($page < $totalPages) echo '?page=' . ($page + 1) . '&search_id=' . urlencode($search_id); ?>">&gt;</a>
            </li>
        </ul>
    </nav>
</div>
