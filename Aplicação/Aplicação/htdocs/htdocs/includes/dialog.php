<h2 class="text-center mb-4 pt-5" style="color: #fe5000; font-weight: bold; font-size: 1.5rem;">INTERAÇÕES</h2>

<div class="container pb-5" style="border-box: 1px;">
    <div class="d-flex flex-column align-items-center">
        <div class="chat col-12 col-md-12 col-lg-12">
            <div class="chat-box shadow-sm p-3"
                style="background-color: white; border-radius: 0.5rem; max-height: 400px; overflow-y: auto;">

                <div class="message mb-3">
                    <div class="sender" style="color: #fe5000; font-weight: bold; font-size: 0.85rem;">Guilherme</div>
                    <div class="timestamp small text-muted" style="font-size: 0.75rem;">18/06</div>
                    <div class="content"
                        style="background-color: #e9ecef; padding: 10px; border-radius: 0.5rem; margin-top: 5px; font-size: 0.85rem;">
                        Exemplo de um comentário longo que se ajusta para legibilidade na tabela.</div>
                </div>
                <hr>

                <div class="message mb-3">
                    <div class="sender" style="color: #fe5000; font-weight: bold; font-size: 0.85rem;">Você</div>
                    <div class="timestamp small text-muted" style="font-size: 0.75rem;">19/06</div>
                    <div class="content"
                        style="background-color: #e9ecef; padding: 10px; border-radius: 0.5rem; margin-top: 5px; font-size: 0.85rem;">
                        Ok, sem problemas</div>
                </div>
                <hr>

                <div class="message mb-3">
                    <div class="sender" style="color: #fe5000; font-weight: bold; font-size: 0.85rem;">Você</div>
                    <div class="timestamp small text-muted" style="font-size: 0.75rem;">19/06</div>
                    <div class="content"
                        style="background-color: #e9ecef; padding: 10px; border-radius: 0.5rem; margin-top: 5px; font-size: 0.85rem;">
                        Ok, sem problemas</div>
                </div>
                <hr>

                <div class="message mb-3">
                    <div class="sender" style="color: #fe5000; font-weight: bold; font-size: 0.85rem;">Você</div>
                    <div class="timestamp small text-muted" style="font-size: 0.75rem;">19/06</div>
                    <div class="content"
                        style="background-color: #e9ecef; padding: 10px; border-radius: 0.5rem; margin-top: 5px; font-size: 0.85rem;">
                        Ok, sem problemas</div>
                </div>
                <hr>

            </div>
            
            <form action="salvar_comentario.php" method="POST" class="input-group mt-2 shadow-sm" style="background-color: #f8f9fa;">
                <input type="text" name="comentario" class="form-control border-0" aria-label="Comentar" placeholder="Digite seu comentário" style="font-size: 0.875rem;" required>
                <button class="btn" type="submit" style="background-color: #fe5000; color: white; font-weight: bold; font-size: 0.875rem;">Enviar</button>
            </form>
            
        </div>
    </div>
</div>

<style>
    .chat-box {
        border-radius: 0.5rem;
        overflow-y: auto;
        box-shadow: black;
    }

    .message {
        margin-bottom: 15px;
    }

    .sender {
        font-size: 0.85rem;
        /* Tamanho da fonte do remetente */
    }

    .content {
        padding: 10px;
        border-radius: 0.5rem;
        background-color: #e9ecef;
        font-size: 0.85rem;
        /* Fonte do comentário um pouco menor */
    }

    .input-group input::placeholder {
        color: #6c757d;
        font-style: italic;
    }
</style>