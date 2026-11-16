
// Função para capitalizar a primeira letra de uma string (para exibir o nome do grupo de forma mais amigável)
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).replace("_", " ");
}

const select = document.getElementById("id_servico");
const valorServicoInput = document.getElementById("valor_servico");
const descricaoServicoInput =  document.getElementById("descricao_servico");

select.addEventListener("change", (e) => {
    // https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Reference/Global_Objects/Array/filter

    let selecID = e.target.value;
    let valorProduto = e.target.options[e.target.selectedIndex].getAttribute('id-valor');
    let infoProduto = e.target.options[e.target.selectedIndex].textContent;
    valorServicoInput.value = parseFloat(valorProduto).toFixed(2);
    descricaoServicoInput.value  = infoProduto.trim();
})

