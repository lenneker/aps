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
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <select name="category" class="form-select" id="floatingSelectGrid" required>
                    <option selected disabled value=""></option>
                    <option value="Desmatamento">Desmatamento</option>
                    <option value="Poluição do Ar">Poluição do Ar</option>
                    <option value="Poluição da Água">Poluição da Água</option>
                    <option value="Poluição Sonora">Poluição Sonora</option>
                    <option value="Queimadas">Queimadas</option>
                    <option value="Lixo e Resíduos">Lixo e Resíduos</option>
                    <option value="Erosão e Degradação do Solo">Erosão e Degradação do Solo</option>
                    <option value="Outro">Outro</option>
                </select>
                <label for="floatingSelectGrid">Selecione a categoria</label>
            </div>
        </div>

        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <input type="text" name="location" class="form-control" id="cep" placeholder="CEP" required
                    pattern="\d{5}-?\d{3}" maxlength="8" onblur="buscarCEP()">
                <label for="cep">Informe o CEP</label>
            </div>
        </div>

        <!-- Campos preenchidos automaticamente -->
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
        <!-- Fim dos campos preenchidos automaticamente -->

        <div class="col-4 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <div class="form-floating shadow">
                <select name="priority" class="form-select" id="floatingSelectGrid3" required>
                    <option value="" disabled selected hidden></option>
                    <option value="Normal">Normal</option>
                    <option value="Urgente">Urgente</option>
                </select>
                <label for="floatingSelectGrid3">Prioridade</label>
            </div>
        </div>

        <div class="form-floating mb-3 col-8 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 p-1">
            <input type="tel" name="phone" class="form-control shadow" id="floatingInput" placeholder="" required>
            <label for="floatingInput">Telefone para contato</label>
            <div class="invalid-feedback">
                O número de telefone deve ter pelo menos 11 dígitos.
            </div>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 p-1">
            <textarea name="description" class="form-control shadow" placeholder="" id="floatingTextarea2"
                style="height: 200px" maxlength="1500" required></textarea>
            <label for="floatingTextarea2">Descreva a irregularidade ambiental.</label>
        </div>

        <div class="mb-3">
            <label for="formFileDisabled" class="form-label">Desabilitado</label>
            <input class="form-control" type="file" id="formFileDisabled" disabled>
        </div>

        <hr>

        <div class="d-grid gap-2 col-6 mx-auto mb-5">
            <button class="btn btn-primary" name="submit" type="submit">Enviar denúncia</button>
            <button class="btn btn-danger" type="button"
                onclick="window.location.href='../pages/tickets-home.php';">Cancelar</button>
        </div>
    </form>

</div>

<script>

    (function () {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        const phoneInput = document.getElementById('floatingInput');

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                const phoneNumber = phoneInput.value.replace(/\D/g, ''); // Obtém apenas dígitos

                // Verifica se o número de telefone tem pelo menos 11 dígitos
                if (phoneNumber.length < 11) {
                    phoneInput.setCustomValidity('O número de telefone deve ter pelo menos 11 dígitos.');
                } else {
                    phoneInput.setCustomValidity(''); // Reseta a mensagem de erro
                }

                // Se o formulário não é válido, previne o envio
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();


    const phoneInput = document.getElementById('floatingInput');

    phoneInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');

        if (value.length > 11) {
            value = value.slice(0, 11);
        }

        // Formata o número
        if (value.length > 6) {
            value = `(${value.substring(0, 2)}) ${value.substring(2, 7)}-${value.substring(7)}`; // (11) 97364-9483
        } else if (value.length > 2) {
            value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
        } else if (value.length > 0) {
            value = `(${value}`;
        }

        e.target.value = value; // Atualiza o valor do input
    });


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