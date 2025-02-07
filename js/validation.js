document.getElementById('clienteForm').addEventListener('submit', function (event) {
    const cpf = document.getElementById('cpf').value;
    const nome = document.getElementById('nome').value;

    // Validação do CPF (formato básico)
    if (!/^\d{3}\.\d{3}\.\d{3}-\d{2}$/.test(cpf)) {
        alert('CPF inválido. Use o formato 000.000.000-00.');
        event.preventDefault();
        return;
    }

    // Validação do Nome (não pode estar vazio)
    if (nome.trim() === '') {
        alert('O campo Nome é obrigatório.');
        event.preventDefault();
        return;
    }
});
