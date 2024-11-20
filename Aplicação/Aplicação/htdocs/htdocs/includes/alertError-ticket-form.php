<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Erro</h5>
            </div>
            <div class="modal-body">
                Ocorreu um erro ao tentar estabelecer a conexão com o banco de dados. Por favor, tente novamente mais
                tarde.
                Se o erro persistir, entre em contato com a equipe de TI para obter suporte.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    onclick="window.location.href='../pages/tickets-home.php';">Ok</button>
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