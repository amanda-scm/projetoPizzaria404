let carrinho = [];

function adicionarAoCarrinho(produto) {
  const existente = carrinho.find(p => p.id === produto.id);
  if (existente) {
    existente.quantidade++;
  } else {
    carrinho.push({...produto, quantidade: 1});
  }
  atualizarCarrinho();
}

function atualizarCarrinho() {
  const lista = document.getElementById('lista-carrinho');
  const totalSpan = document.getElementById('total');
  if (!lista || !totalSpan) return;
  lista.innerHTML = '';
  let total = 0;
  carrinho.forEach(item => {
    const li = document.createElement('li');
    li.textContent = `${item.nome} x${item.quantidade} - R$${(item.preco * item.quantidade).toFixed(2)}`;
    lista.appendChild(li);
    total += item.preco * item.quantidade;
  });
  totalSpan.textContent = total.toFixed(2);
}

function finalizarPedido() {
  alert("Pedido finalizado! Em breve será entregue.");
  carrinho = [];
  atualizarCarrinho();
}

// Exemplo de produtos (substituir com dados do backend futuramente)
document.addEventListener('DOMContentLoaded', () => {
  const produtos = [
    { id: 1, nome: 'Pizza Calabresa', preco: 35.00 },
    { id: 2, nome: 'Pizza 4 Queijos', preco: 38.00 }
  ];
  const container = document.getElementById('produtos');
  if (container) {
    produtos.forEach(prod => {
      const div = document.createElement('div');
      div.innerHTML = `<h3>${prod.nome}</h3><p>R$ ${prod.preco.toFixed(2)}</p><button onclick='adicionarAoCarrinho(${JSON.stringify(prod)})'>Adicionar</button>`;
      container.appendChild(div);
    });
  }
});

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

// Começa o carrossel automático
mostrarSlide(slideAtual);
setInterval(proximoSlide, 3000); // troca a cada 3 segundos