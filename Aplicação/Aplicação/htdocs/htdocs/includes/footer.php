<style>
    a.text-white {
        color: white;
        text-decoration: none;
        position: relative;
        transition: color 0.7s ease;
    }

    a.text-white::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        display: block;
        background: black;
        transition: width 0.7s ease;
        bottom: -2px;
        left: 0;
    }

    a.text-white:hover {
        color: #555854 !important;
    }


    footer {
        font-size: 0.9rem;
    }

    footer h5 {
        font-size: 1.25rem;
    }

    .fs-4 {
        font-size: 1.1rem;
    }
</style>

<footer style="background-color: #AC1B2F; color: #ffffff;" class="py-5">
    <div class="container">
        <div class="row text-center text-md-start"> 
            <div class="col-12 col-sm-6 col-md-4 text-center">
                <h5 class="mb-3" style="font-weight: bold;">Prefeitura de São Paulo</h5>
                <p><strong>CNPJ:</strong> 49.496.420/0001-08</p>
                <p><strong>Endereço:</strong> Viaduto do Cha, 15 - Downtown - São Paulo - CEP: 01002-020
                </p>
            </div>

            <div class="col-12 col-sm-6 col-md-4 text-center">
                <h5 class="mb-3" style="font-weight: bold;">Siga a Prefeitura</h5>
                <p class="mb-2">Fique por dentro dos nossos projetos:</p>
                <a href="https://www.instagram.com/prefsp/?hl=ens" target="blank" class="text-white me-2" aria-label="Instagram"><i class="bi bi-instagram fs-4"></i></a>
                <a href="https://br.linkedin.com/company/prefeitura-de-s%C3%A3o-paulo" target="blank" class="text-white me-2" aria-label="LinkedIn"><i class="bi bi-linkedin fs-4"></i></a>
                <a href="https://www.youtube.com/prefeiturasaopaulo" target="blank" class="text-white me-2" aria-label="Twitter"><i class="bi bi-youtube fs-4"></i></a>
            </div>

            <div class="col-12 col-md-4 mt-4 mt-md-0 text-center">
                <h5 class="mb-3" style="font-weight: bold;">Recursos Institucionais</h5>
                <ul class="list-unstyled">
                    <li><a href="" target="blank" class="text-white" style="text-decoration: underline;">Canal de Denúncia</a></li>
                    <li><a href="" target="blank" class="text-white" style="text-decoration: underline;">Código de Conduta e Ética</a>
                    </li>
                    <li><a href="" target="blank" class="text-white" style="text-decoration: underline;">Site</a></li>
                </ul>
            </div>

            <hr class="p-2">

            <div class="col-12 text-center">
                <p class="mb-0">Todos os direitos reservados &copy; 2024 <strong>Prefeitura de São Paulo</strong>.</p>
            </div>

            <div class="col-12 text-center mt-3">
                <br>
                <img src="" alt="" class="img-fluid" style="max-width: 120px;">
                <br>
            </div>

        </div>
    </div>
</footer>