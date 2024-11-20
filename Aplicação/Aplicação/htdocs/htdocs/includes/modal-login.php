  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  

  <style>
    .alert-overlay {
      position: fixed; /* Para sobrepor o conteúdo da página */
      top: 20px; /* Ajusta a distância do topo */
      right: 20px; /* Ajusta a distância da direita */
      z-index: 1050; /* Garante que o alerta fique sobre os outros elementos */
      opacity: 0; /* Inicia invisível */
      transition: opacity 0.5s ease-in-out; /* Animação de fade */
    }

    .alert-overlay.show {
      opacity: 1; 
    }

    .alert-overlay.hide {
      opacity: 0; 
    }
  </style>
</head>
<body>


  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
  </svg>

  <div id="alert" class="alert alert-success alert-overlay d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
      <use xlink:href="#check-circle-fill"/>
    </svg>
    <div>
      Login realizado com sucesso!
    </div>
  </div>

  <script>

    function showAlert() {
      const alertElement = document.getElementById('alert');
      alertElement.classList.add('show');
      alertElement.classList.remove('hide');

      // Após 3 segundos, inicia o fade-out
      setTimeout(function() {
        alertElement.classList.add('hide');
        alertElement.classList.remove('show');
      }, 3000); // Alerta será visível por 3 segundos
    }

    // Exemplo: chama a função para mostrar o alerta
    document.addEventListener('DOMContentLoaded', function () {
      showAlert(); // Você pode chamar essa função em outro evento, como após um login bem-sucedido
    });
  </script>

</body>
</html>
