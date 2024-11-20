<?php
include('../includes/protect.php');
include("../config/variables/connection.php");

$userid = $_SESSION["userid"];
$message = '';

if (isset($_POST['submit'])) {
    // Captura os valores do formulário
    $phone = $_POST['phone'];
    $phone = preg_replace('/[^0-9]/', '', $phone); // Remove todos os caracteres que não são dígitos
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];  // O CEP é enviado como 'location'
    $priority = $_POST['priority'];
    $logradouro = $_POST['logradouro'];  // Dados do logradouro preenchidos automaticamente
    $bairro = $_POST['bairro'];         // Dados do bairro preenchidos automaticamente
    $cidade = $_POST['cidade'];         // Dados da cidade preenchidos automaticamente
    $estado = $_POST['estado'];         // Dados do estado preenchidos automaticamente

    // Agora, o campo location (CEP) será usado diretamente
    $insert = mysqli_query($mysqli, "INSERT INTO tickets (user_id, phone, category, description, location, priority, logradouro, bairro, cidade, estado) 
    VALUES('$userid', '$phone', '$category', '$description', '$location', '$priority', '$logradouro', '$bairro', '$cidade', '$estado')");

    if ($insert) {
        $ticketId = mysqli_insert_id($mysqli);
        include_once '../includes/alertSucess-ticket-form.php';
    } else {
        include_once '../includes/alertError-ticket-form-error.php';
    }
}
?>

<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../assets/css/index.css">
<link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<div class="container d-flex justify-content-center align-items-center pt-5">
    <form class="row g-3 needs-validation" method="POST" novalidate>

        <!-- Campos preenchidos automaticamente (Código resumido) -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro"
                    readonly>
                <label for="logradouro">Logradouro</label>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" readonly>
                <label for="bairro">Bairro</label>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" readonly>
                <label for="cidade">Cidade</label>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" readonly>
                <label for="estado">Estado</label>
            </div>
        </div>
        <!-- Fim dos campos preenchidos automaticamente (Código resumido) -->
    </form>

</div>

<script>

    phoneInput.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' || e.key === 'Delete') {
            const currentValue = e.target.value;
            const lastChar = currentValue[currentValue.length - 1];
            if (lastChar === '-') {

                e.target.value = currentValue.slice(0, -2);
                e.preventDefault();
            }
        }
    });

    // Atualize os campos visíveis e escondidos no preenchimento automático do CEP
    function buscarCEP() {
        const cep = document.getElementById('cep').value.replace(/\D/g, '');

        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        // Preenche os campos visíveis
                        document.getElementById('logradouro').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;

                        // Atualiza os campos escondidos
                        document.querySelector('input[name="logradouro"]').value = data.logradouro;
                        document.querySelector('input[name="bairro"]').value = data.bairro;
                        document.querySelector('input[name="cidade"]').value = data.localidade;
                        document.querySelector('input[name="estado"]').value = data.uf;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    alert('Erro ao buscar o CEP');
                });
        } else {
            alert('CEP inválido.');
        }
    }


</script>

<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>