// mask obervações
var observacoesTreino = document.getElementById('observacoes_treino_editar');
observacoesTreino.addEventListener('input', function(e) {
    var value = e.target.value;

    if (!value.startsWith('* ')) {
        value = '* ' + value.trim();
    }

    value = value.charAt(0).toUpperCase() + value.slice(1);

    e.target.value = value;
});

observacoesTreino.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Impede a quebra de linha padrão
    }
});

// mask input aula
document.getElementById('aula_treino_editar').addEventListener('input', function(e) {
  var value = e.target.value;
  value = value.replace(/[^\d]/g, ''); // remove todos os caracteres que não são dígitos
  if (value.length > 0) {
      value = value + 'ª'; // adiciona 'ª' no final se a string não estiver vazia
  }
  e.target.value = value;
});


// verificando o numero de imagens adicionar no input
document.addEventListener("DOMContentLoaded", function() {
    // Seleciona o input pelo seu ID
    var input = document.getElementById("novas-imagens-treino");

    // Adiciona um ouvinte de evento para quando o valor do input mudar
    input.addEventListener("change", function() {
      // Verifica se o número de arquivos selecionados é maior que 3
      if (this.files.length > 1) {
        // Informa ao usuário que ele não pode selecionar mais de 3 arquivos
        alert("Você pode selecionar no máximo 1 imagens.");
        // Limpa os arquivos selecionados
        this.value = "";
      }
    });
});


// remover imagem treino modal editar
async function removerImgTreinoModalEditar(refContainerImg, id, imgName){
    const res = await fetch(`${base_url}/modulos-admin/contents/treinos/php/deletar-img-treino.php?id=${id}&imgName=${imgName}`)
    const data = await res.json()
    if(data.status == 'success'){
        document.getElementById(refContainerImg).remove()
    }
}