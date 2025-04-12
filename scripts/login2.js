window.onload = function() {
    // Obter os parâmetros da URL
    const params = new URLSearchParams(window.location.search);
    const error = params.get('error');

    // Verificar se o parâmetro "error" existe
    if (error) {
        let errorMessage = '';

        // Mapear os erros para mensagens amigáveis
        switch (error) {
            case 'emptyinput':
                errorMessage = 'Por favor, preencha todos os campos.';
                break;
            case 'wronglogin':
                errorMessage = 'Email ou senha incorretos. Tente novamente.';
                break;
            case 'stmtfailed':
                errorMessage = 'Ocorreu um erro no servidor. Tente novamente mais tarde.';
                break;
            default:
                errorMessage = 'Ocorreu um erro desconhecido.';
        }

        // Exibir o alerta com a mensagem de erro
        alert(errorMessage);
    }
};