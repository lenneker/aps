<style>
    .svg-logo {
        display: block;
        margin: 0 auto;
        width: 55px;
        height: auto;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        height: 100%;
    }

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
        transition: width 0.7s ease;
        bottom: -2px;
        left: 0;
    }
</style>

<nav class="navbar navbar-expand-lg navbar" style="background-color: #AC1B2F;"> <!-- Cor laranja -->
    <div class="container">

        <a class="navbar-brand" href="../../admin-area/admin-home.php">
            
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item" style="margin-right: 20px;">
                    <a class="nav-link active text-white" href="../pages/home.php">Página inicial</a>
                </li>
                <li class="nav-item" style="margin-right: 20px;">
                    <a class="nav-link text-white" href="create-user.php">Criar usuário</a>
                </li>
                
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="../includes/logout.php" class="btn btn-danger btn-md"
                        style="border-radius: 4px; font-weight:;">
                        Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>