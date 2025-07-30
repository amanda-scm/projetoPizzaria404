let slideAtual = 0;

function mostrarSlide(index) {
  const links = document.querySelectorAll(".quadro-imagens a");
  links.forEach((link, i) => {
    const img = link.querySelector("img");
    img.classList.remove("ativo");
    if (i === index) {
      img.classList.add("ativo");
    }
  });
}

function proximoSlide() {
  const slides = document.querySelectorAll(".slide");
  slideAtual = (slideAtual + 1) % slides.length;
  mostrarSlide(slideAtual);
}

// Categoria de sabores (filtros)
document.addEventListener('DOMContentLoaded', () => {
  mostrarSlide(slideAtual);
  setInterval(proximoSlide, 3000);

  const botoes = document.querySelectorAll('.botoes-categorias button');
  const sabores = document.querySelectorAll('.sabor-card');

  botoes.forEach(botao => {
    botao.addEventListener('click', () => {
      const categoria = botao.dataset.categoria;
      sabores.forEach(card => {
        card.style.display = card.classList.contains(categoria) ? 'flex' : 'none';
      });
      botoes.forEach(b => b.classList.remove('ativo'));
      botao.classList.add('ativo');
    });
  });

  botoes[0]?.click();

  // Fechar carrinho
  const btnFechar = document.getElementById('fechar-carrinho');
  if (btnFechar) {
    btnFechar.onclick = () => {
      document.getElementById('carrinho').style.display = 'none';
      document.getElementById('overlay').style.display = 'none';
    };
  }


  const overlay = document.getElementById('overlay');
  if (overlay) {
    overlay.onclick = () => {
      document.getElementById('carrinho').style.display = 'none';
      overlay.style.display = 'none';
    };
  }
});

function buscarProduto(event){
  event.preventDefault();
  const termo = document.getElementById("campoBusca").value;
  alert("Buscar por:"+ termo);

}
function toggleCarrinho(){
  alert("Abrir carrinho...");
}


