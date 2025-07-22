// Carrega o carrinho salvo ou começa vazio
let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

// Salva no localStorage
function salvarCarrinho() {
  localStorage.setItem("carrinho", JSON.stringify(carrinho));
}

function adicionarAoCarrinho(produto) {
  const existente = carrinho.find(p => p.id === produto.id);
  if (existente) {
    existente.quantidade++;
  } else {
    carrinho.push({ ...produto, quantidade: 1 });
  }
  salvarCarrinho();
  atualizarCarrinho();
}

function atualizarCarrinho() {
  const lista = document.getElementById('lista-carrinho');
  const totalSpan = document.getElementById('total');
  if (!lista || !totalSpan) return;

  lista.innerHTML = '';
  let total = 0;

  if (carrinho.length === 0) {
    const li = document.createElement('li');
    li.textContent = 'Carrinho vazio';
    lista.appendChild(li);
    totalSpan.textContent = '0.00';
    return;
  }

  carrinho.forEach(item => {
    const li = document.createElement('li');
    li.textContent = `${item.nome} x${item.quantidade} - R$${(item.preco * item.quantidade).toFixed(2)}`;
    lista.appendChild(li);
    total += item.preco * item.quantidade;
  });

  totalSpan.textContent = total.toFixed(2);
}

function toggleCarrinho() {
  const carrinhoElement = document.getElementById('carrinho');
  const overlay = document.getElementById('overlay');

  if (!carrinhoElement || !overlay) return;

  const visivel = carrinhoElement.style.display === 'block';
  if (visivel) {
    carrinhoElement.style.display = 'none';
    overlay.style.display = 'none';
  } else {
    atualizarCarrinho(); // mostra "Carrinho vazio" se necessário
    carrinhoElement.style.display = 'block';
    overlay.style.display = 'block';
  }
}

function finalizarPedido() {
  if (carrinho.length === 0) {
    alert("Carrinho vazio!");
    return;
  }

  alert("Pedido finalizado (simulação).");
  carrinho = [];
  salvarCarrinho();
  atualizarCarrinho();
}

// Carrossel de slides
let slideAtual = 0;

function mostrarSlide(index) {
  const slides = document.querySelectorAll(".slide");
  slides.forEach((slide, i) => {
    slide.classList.remove("ativo");
    if (i === index) {
      slide.classList.add("ativo");
    }
  });
}

function proximoSlide() {
  const slides = document.querySelectorAll(".slide");
  slideAtual = (slideAtual + 1) % slides.length;
  mostrarSlide(slideAtual);
}

// Categoria de sabores
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

  // Overlay fecha o carrinho
  const overlay = document.getElementById('overlay');
  if (overlay) {
    overlay.onclick = () => {
      document.getElementById('carrinho').style.display = 'none';
      overlay.style.display = 'none';
    };
  }

  atualizarCarrinho(); // sempre que carregar a página
});
