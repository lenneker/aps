<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Centraliza o modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Denúncia enviada!</h5>

            </div>
            <div class="modal-body">
            Sua denúncia foi encaminhada para a Prefeitura. Em breve, nossa equipe entrará em contato com você. Por favor, acompanhe seu e-mail e telefone para novas atualizações.
                <br><br>
                <strong>Protocólo número: #<?php echo $ticketId; ?></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    onclick="window.location.href='../pages/tickets-home.php';">
                    Ciente
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mostrar o modal automaticamente
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
</script>
