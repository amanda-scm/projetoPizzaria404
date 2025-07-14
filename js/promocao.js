function toggleCarrinho() {
    alert("Carrinho será implementado em breve."); // placeholder
  }
  
  // Busca por produto ou promoção
  function buscarProduto(event) {
    event.preventDefault();
    const termo = document.getElementById('campoBusca').value.toLowerCase();
  
    // Exemplo simples de filtro de promoções visíveis na página
    const promocoes = document.querySelectorAll('.promocao-card');
  
    let encontrou = false;
  
    promocoes.forEach(card => {
      const titulo = card.querySelector('h3').innerText.toLowerCase();
      const descricao = card.querySelector('p').innerText.toLowerCase();
  
      if (titulo.includes(termo) || descricao.includes(termo)) {
        card.style.display = 'block';
        encontrou = true;
      } else {
        card.style.display = 'none';
      }
    });
  
    if (!encontrou) {
      alert("Nenhuma promoção encontrada com esse termo.");
    }
  }