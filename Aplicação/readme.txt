Para utilizar a aplicação, basta mover a pasta htdocs para o diretório "Aplicação/htdocs" dentro de um servidor web com acesso público.

Além disso, é necessário importar os arquivos do banco de dados para que a aplicação funcione corretamente.

Dentro do diretório htdocs/config/variables/ da aplicação, você encontrará o arquivo de configuração do banco de dados. É importante ajustar as configurações de acordo com o seu ambiente de testes.

Para habilitar o microserviço de envio de e-mails, você precisará de uma conta com o protocolo SMTP ativado. As contas configuradas anteriormente foram excluídas pela Microsoft, possivelmente por parecerem contas de spam. Portanto, será necessário criar uma nova conta, ativar o protocolo SMTP e configurar o usuário no microserviço.