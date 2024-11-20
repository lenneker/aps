<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="d-flex container justify-content-center pt-5 pl-5 pr-5">
    <div class="d-flex align-items-center justify-content-between col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 gap-3">

         <div class="card w-50 shadow position-relative">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><strong>Chamados<br>abertos</strong></h5>
                <p class="card-text">Veja os chamados não concluídos.</p>
                <a href="../admin-area/admin-open-tickets.php" class="btn btn-primary mt-auto">Visualizar solicitações</a>
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <i class="bi bi-question-circle" style="font-size: 32px;"></i>
                </div>
            </div>
        </div>

        <div class="card w-50 shadow position-relative">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><strong>Histórico<br>de chamados</strong></h5>
                <p class="card-text">Veja todos os chamados que já foram fechados.</p>
                <a href="../../admin-area/admin-ticket-history.php" class="btn btn-secondary mt-auto">Histórico de chamados</a>
                <div class="position-absolute top-0 end-0 mt-2 me-2">
                    <i class="bi bi-clock-history" style="font-size: 32px;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function equalizeCardSizes() {
        const cards = document.querySelectorAll('.card');
        let maxHeight = 0;
        let maxWidth = 0;

        cards.forEach(card => {
            card.style.height = 'auto';
            card.style.width = 'auto';
            const cardHeight = card.offsetHeight;
            const cardWidth = card.offsetWidth;

            if (cardHeight > maxHeight) maxHeight = cardHeight;
            if (cardWidth > maxWidth) maxWidth = cardWidth;
        });

        cards.forEach(card => {
            card.style.height = `${maxHeight}px`;
            card.style.width = `${maxWidth}px`;
        });
    }

    window.addEventListener('DOMContentLoaded', equalizeCardSizes);
    window.addEventListener('resize', equalizeCardSizes);
</script>
