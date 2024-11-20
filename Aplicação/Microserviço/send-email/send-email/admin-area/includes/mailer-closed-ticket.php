<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclua o autoload do Composer
require __DIR__ . '/../../vendor/autoload.php';

// Função para enviar e-mail
function sendTicketClosedEmail($user_email, $id, $description, $resolution_justification, $attendant)
{
    // Verifica se o e-mail é válido
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        error_log('E-mail inválido: ' . $user_email);
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = ''; // Preencher
        $mail->Password = ''; // Senha SMTP // Preencher
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(''); // Preencher
        $mail->addAddress($user_email); 
        
        

        $mail->CharSet = 'UTF-8';  

        // Conteúdo do e-mail em HTML
        $mail->isHTML(true);
        $mail->Subject = 'CONCLUSÃO DA DENÚNCIA - PROTOCOLO #' . htmlspecialchars($id) . '';

      
        $mail->Body = '
        <html>
        <head>
            <title>Fechamento da Denúncia</title>
            <style>
                body {
                    font-family: "Arial", sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #ffffff;
                    color: #333;
                }
                .container {
                    width: 100%;
                    background-color: #f9f9f9;
                    padding: 20px 0;
                }
                .email-content {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border-radius: 8px;
                    overflow: hidden;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                }
                .header {
                    background-color: #AC1B2F;
                    color: #ffffff;
                    padding: 20px;
                    text-align: center;
                    font-size: 24px;
                    font-weight: bold;
                }
                .content {
                    padding: 20px;
                    color: #555555;
                }
                .content h2 {
                    color: #AC1B2F;
                    font-size: 20px;
                    margin-bottom: 10px;
                    text-align: justify;
                }
                .content p {
                    margin: 10px 0;
                    font-size: 13px;
                    line-height: 1.6;
                    text-align: justify;
                }
                .message-box {
                    padding: 15px;
                    background-color: #f0f0f0;
                    border-left: 5px solid #AC1B2F;
                    margin-bottom: 20px;
                    font-size: 16px;
                    text-align: justify;
                }
                .responsible-box {
                    padding: 15px;
                    background-color: #f9f9f9;
                    border: 1px solid #AC1B2F;
                    border-radius: 5px;
                    margin-bottom: 20px;
                }
                .footer {
                    background-color: #f8f8f8;
                    padding: 20px;
                    text-align: center;
                    font-size: 12px;
                    color: #777777;
                    border-top: 1px solid #eeeeee;
                }
                .footer a {
                    color: #AC1B2F;
                    text-decoration: none;
                }
                .footer a:hover {
                    text-decoration: underline;
                }
                .disclaimer {
                    font-size: 11px;
                    color: #777777;
                    text-align: justify;
                }
            </style>
        </head>
        <body>
            <table class="container" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center">
                        <table class="email-content" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td class="header">
                                    Conclusão da Denúncia - Protocolo #' . htmlspecialchars($id) . '
                                </td>
                            </tr>
                            <tr>
                                <td class="content">
                                    <div class="message-box">
                                        <h2>Denúncia finalizada com sucesso!</h2>
                                    </div>
                                    <p>Olá! Informamos que sua denúncia foi finalizada com sucesso sob o protocolo #' . htmlspecialchars($id) . '. Agradecemos por nos ajudar a preservar o meio ambiente. Caso tenha mais dúvidas ou queira fazer uma nova denúncia, estamos à disposição.</p>
                                    <h3 style="color: #AC1B2F; font-size: 18px; margin-bottom: 10px;">Responsável pelo atendimento: <strong>' . htmlspecialchars($attendant) . '</strong></h3>
                                    <hr>

                                    <div class="responsible-box">
                                        <p><strong>Descrição da denúncia: </strong> ' . htmlspecialchars($description) . '</p>
                                        <p><strong>Justificativa da resolução: </strong>' . htmlspecialchars($resolution_justification) . ' </p>
                                        <p>Atenciosamente,</p>
                                        <p>' . htmlspecialchars($attendant) . '.</p>
                                    </div>
                                    <hr>
                                    <p>Informamos que, uma vez encerrada, a denúncia não pode ser reaberta. Para novas questões ou caso deseje relatar outra irregularidade, pedimos que registre um novo protocolo em nossa plataforma. A descrição da denúncia é importante para nossos registros e a resolução do caso.</p>
                                    <p>Esta é uma mensagem gerada automaticamente. Solicitamos que não responda a este e-mail, pois ele não é monitorado, e qualquer resposta será descartada.</p>

                                    </td>
                            </tr>
                            <tr>
                                <td align="center" style="background-color: #AC1B2F; height: 1px;"></td>
                            </tr>
                            <tr>
                                <td class="footer">
                                    <p class="disclaimer">AVISO LEGAL: Esta mensagem, incluindo seus anexos, é destinada exclusivamente para a(s) pessoa(s) a quem ela é dirigida, podendo conter informação confidencial e/ou privilegiada. Cabe a seus destinatários, inclusive aqueles em cópia, tratá-la adequadamente e com observância da legislação em vigor. Está proibida a sua divulgação, reprodução e distribuição sem a devida autorização. A inobservância das proibições será passível de aplicação de sanções cíveis, criminais e disciplinares, quando cabíveis. Se você recebeu esta mensagem indevidamente, antes de removê-la de sua caixa postal, entre em contato com o remetente para informar o ocorrido.</p>
                                    <p>&copy; ' . date("Y") . ' Prefeitura de São Paulo. Todos os direitos reservados.</p> 
                                     
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background-color: #AC1B2F; height: 5px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';

        $mail->AltBody = 'Prezado(a) Cliente, sua denúncia com o protocolo #' . htmlspecialchars($id) . ' foi fechada com sucesso. Agradecemos pela confiança depositada na Unità Engenharia.';

        // Envia o e-mail
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Registro do erro para análise futura
        error_log('Erro ao enviar o e-mail: ' . $mail->ErrorInfo);
        return false;
    }
}
?>
