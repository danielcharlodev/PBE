function aplicarMascaraCpf(input) {
    let valor = input.value.replace(/\D/g, '').slice(0, 11);

    if (valor.length > 9) {
        valor = valor.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
    } else if (valor.length > 6) {
        valor = valor.replace(/(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
    } else if (valor.length > 3) {
        valor = valor.replace(/(\d{3})(\d{0,3})/, '$1.$2');
    }

    input.value = valor;
}

function aplicarMascaraTelefone(input) {
    let valor = input.value.replace(/\D/g, '').slice(0, 11);

    if (valor.length > 10) {
        valor = valor.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
    } else if (valor.length > 6) {
        valor = valor.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
    } else if (valor.length > 2) {
        valor = valor.replace(/(\d{2})(\d{0,5})/, '($1) $2');
    }

    input.value = valor;
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-mask="cpf"]').forEach((input) => {
        input.addEventListener('input', () => aplicarMascaraCpf(input));
        aplicarMascaraCpf(input);
    });

    document.querySelectorAll('[data-mask="telefone"]').forEach((input) => {
        input.addEventListener('input', () => aplicarMascaraTelefone(input));
        aplicarMascaraTelefone(input);
    });
});
