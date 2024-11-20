<style>

    .svg-logo {
        display: block;
        margin: 0 auto;
        width: 55px;
        height: auto;
        display: none;
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

<nav class="navbar navbar-expand-lg navbar" style="background-color: #AC1B2F;"> 
    <div class="container">
        <a class="navbar-brand" href="../pages/home.php">
            <svg class="svg-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 6 115 80" width="55" height="30" fill="white">
                <path d="M108.16,25.97c-1.99-1.61-4.45-2.87-7.31-3.75c-2.83-0.87-6.09-1.31-9.67-1.31c-2.85,0-5.6,0.26-8.17,0.78  
                c-2.56,0.51-5.01,1.19-7.29,2.01c-2.27,0.82-4.45,1.74-6.47,2.75c-1.35,0.67-2.64,1.36-3.9,2.04v-6.25h-0.69H49.79h-0.73V56  
                c-1.21,0.94-2.55,1.86-3.99,2.74c-1.85,1.13-3.82,2.14-5.86,3.01c-2.03,0.87-4.11,1.57-6.18,2.09c-2.05,0.52-4.03,0.78-5.89,0.78  
                c-2.46,0-4.47-0.3-5.97-0.88c-1.47-0.57-2.61-1.38-3.41-2.39c-0.81-1.03-1.38-2.3-1.68-3.76c-0.32-1.53-0.48-3.26-0.48-5.16V22.25H0  
                v36.5c0,2.83,0.54,5.44,1.61,7.75c1.07,2.31,2.63,4.31,4.64,5.93c1.99,1.61,4.46,2.87,7.33,3.75c2.85,0.87,6.11,1.31,9.69,1.31  
                c2.85,0,5.6-0.27,8.17-0.8c2.56-0.52,5.01-1.21,7.29-2.05c2.27-0.83,4.45-1.78,6.47-2.81c1.33-0.68,2.61-1.37,3.86-2.05v6.22h0.73  
                h14.87h0.69V42.26c1.2-0.94,2.53-1.86,3.99-2.74c1.85-1.11,3.81-2.11,5.85-2.95c2.04-0.84,4.12-1.53,6.19-2.04  
                c2.05-0.5,4.03-0.76,5.89-0.76c2.43,0,4.43,0.3,5.95,0.88c1.48,0.57,2.64,1.38,3.45,2.4c0.82,1.03,1.39,2.3,1.7,3.76  
                c0.32,1.53,0.48,3.26,0.48,5.16v30.03h15.56V39.65c0-2.83-0.54-5.44-1.61-7.75C111.73,29.59,110.17,27.59,108.16,25.97" />
            </svg>
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
                    <a class="nav-link text-white" href="https://wa.me/5511972419431" target="blank">Reportar bugs</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="../includes/logout.php" class="btn btn-danger btn-md" style="border-radius: 4px;">
                        Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
