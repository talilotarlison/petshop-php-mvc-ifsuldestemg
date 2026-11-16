// Lista das classes a manipular

const classes = ['clientes', 'atendimentos', 'concluidos', 'andamento', 'pendente'];

classes.forEach(classe => {
  const elemento = document.querySelector(`.${classe}`);
  if (elemento) {
    const valor = parseFloat(elemento.textContent) || 0; // garante número
    elemento.style.width = `${valor}%`;
  }
});
