
const cpfInput = document.getElementById('cpf');

cpfInput.addEventListener('input', () => {
  // Remove pontos e traços do valor atual
  cpfInput.value = cpfInput.value.replace(/[.\-]/g, '');

  // Só valida se o CPF tiver 11 dígitos
  if (cpfInput.value.length === 11) {
    if (!validarCPF(cpfInput.value)) {
      alert("Coloque um CPF válido!");
      cpfInput.focus();
    }
  }
});

function validarCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11) return false;

    // Rejeita CPFs com todos os dígitos iguais
    if (/^(\d)\1{10}$/.test(cpf)) return false;

    // Valida 1º dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = (soma * 10) % 11;
    if (resto === 10) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;

    // Valida 2º dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10) resto = 0;
    if (resto !== parseInt(cpf.charAt(10))) return false;

    return true;
}
