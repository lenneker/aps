<style>
    * {
        box-sizing: border-box;
    }

    .icon {
        color: black;
        font-size: 2rem;
    }

    .card-text {
        color: gray;
    }

    .card:hover {
        background-color: #AC1B2F;
        color: #ffffff;
    }

    .card:hover .icon,
    .card:hover .card-text {
        color: #ffffff;
    }

    .card {
        border-radius: 5px !important;

        transition: all 0.5s;
        overflow: hidden;
        padding-bottom: 20px;
    }
</style>

<div class="container p-5">
    <div class="row justify-content-center">
        <!-- CARD 1 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-5 col-xl-4 col-xxl-4 p-2">
            <a href="../pages/open-ticket.php" class="text-decoration-none">
                <div class="card text-center border-0 shadow rounded-0 p-1">
                    <div class="icon">
                        <i class="bi bi-person-raised-hand"></i>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Denúnciar</h4>
                        <p class="card-text">Denuncie irregularidades ambientais para a Prefeitura de São Paulo.</p>
                        <link rel="stylesheet"
                            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                    </div>
                </div>
            </a>
        </div>

        <!-- CARD 2 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-5 col-xl-4 col-xxl-4 p-2">
            <a href="../pages/tickets-home.php" class="text-decoration-none">
                <div class="card text-center border-0 shadow rounded-0 p-1">
                    <div class="icon">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Status da Denúncia</h4>
                        <p class="card-text">Acompanhe o andamento das suas solicitações.</p>
                        <link rel="stylesheet"
                            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                    </div>
                </div>
            </a>
        </div>

        <!-- CARD 3 -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-5 col-xl-4 col-xxl-4 p-2 position-relative">

                <div class="card text-center border-0 shadow rounded-0 p-1">
                    <div class="icon">
                        <i class="bi bi-menu-button-fill"></i>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title fw-bold">Problemas Resolvidos</h4>
                        <p class="card-text">Principais problemas ambientais superados.</p>
                    </div>
                    <span class="badge bg-danger text-white position-absolute"
                        style="top: 0px; right: -9px; padding: 0.5rem 0.75rem; border-radius: 0.5rem;">Em
                        Desenvolvimento.</span>
                </div>
            
        </div>

    </div>


    <script>
        window.addEventListener('load', function () {
            const cards = document.querySelectorAll('.card'); // Seleciona todos os elementos com a classe "card"
            let maxHeight = 0;

            // Calcula a altura máxima dos cards
            cards.forEach(card => {
                let cardHeight = card.offsetHeight;
                if (cardHeight > maxHeight) {
                    maxHeight = cardHeight;
                }
            });

            // Aplica a altura máxima a todos os cards
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        });

        // Atualiza os cards quando a tela é redimensionada
        window.addEventListener('resize', function () {
            const cards = document.querySelectorAll('.card');
            let maxHeight = 0;

            // Remove a altura definida anteriormente
            cards.forEach(card => {
                card.style.height = 'auto';
            });

            // Recalcula a altura máxima
            cards.forEach(card => {
                let cardHeight = card.offsetHeight;
                if (cardHeight > maxHeight) {
                    maxHeight = cardHeight;
                }
            });

            // Reaplica a altura máxima
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        });
    </script>