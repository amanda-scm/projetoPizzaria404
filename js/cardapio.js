const pizzas = [
  { codigo: 1, nome: "Margherita", tamanho: "Média", preco: 30.00 },
  { codigo: 2, nome: "Calabresa", tamanho: "Grande", preco: 42.50 },
  { codigo: 3, nome: "Quatro Queijos", tamanho: "Pequena", preco: 28.90 },
  { codigo: 4, nome: "Frango com Catupiry", tamanho: "Grande", preco: 44.00 },
  { codigo: 5, nome: "Portuguesa", tamanho: "Média", preco: 35.00 },
  { codigo: 6, nome: "Vegetariana", tamanho: "Pequena", preco: 27.00 },
  { codigo: 7, nome: "Pepperoni", tamanho: "Grande", preco: 45.50 },
  { codigo: 8, nome: "Bacon", tamanho: "Média", preco: 38.00 },
  { codigo: 9, nome: "Napolitana", tamanho: "Pequena", preco: 26.00 },
  { codigo: 10, nome: "Moda da Casa", tamanho: "Grande", preco: 49.90 },
];

const produtosContainer = document.getElementById('produtos');
const listaCarrinho = document.getElementById('lista-carrinho');
const totalSpan = document.getElementById('total');

let carrinho = [];

function renderizarCardapio() {
  produtosContainer.innerHTML = '';

  pizzas.forEach(pizza => {
    const card = document.createElement('div');
    card.classList.add('pizza-card');

    card.innerHTML =  `
      <h3 class="pizza-nome">${pizza.nome}</h3>
      <p class="pizza-tamanho">${pizza.tamanho}</p>
      <p>Preço: R$ ${pizza.preco.toFixed(2)}</p>
      <button class="add-btn" onclick="adicionarAoCarrinho(${pizza.codigo})">Adicionar ao carrinho</button>
    `;
    
    produtosContainer.appendChild(card);
  });
}

function buscarPizza(event) {
  event.preventDefault();
  const termo = document.getElementById('campoBusca').value.toLowerCase();

  const pizzasCards = document.querySelectorAll('.pizza-card');

  pizzasCards.forEach(card => {
    const nome = card.querySelector('.pizza-nome').innerText.toLowerCase();
    const tamanho = card.querySelector('.pizza-tamanho').innerText.toLowerCase();

    if (nome.includes(termo) || tamanho.includes(termo)) {
      card.style.display = 'block';
    } else {
      card.style.display = 'none';
    }
  });
}

function adicionarAoCarrinho(codigoPizza) {
  const pizza = pizzas.find(p => p.codigo === codigoPizza);
  if (!pizza) return;

  const itemCarrinho = carrinho.find(item => item.codigo === codigoPizza);
  if (itemCarrinho) {
    itemCarrinho.quantidade += 1;
  } else {
    carrinho.push({ ...pizza, quantidade: 1 });
  }
  atualizarCarrinho();
}

function removerDoCarrinho(codigoPizza) {
  carrinho = carrinho.filter(item => item.codigo !== codigoPizza);
  atualizarCarrinho();
}

function atualizarCarrinho() {
  listaCarrinho.innerHTML = '';

  let total = 0;
  const overlay = document.getElementById('overlay');
  const carrinhoElement = document.getElementById('carrinho');
  if (carrinho.length === 0) {
    carrinhoElement.style.display = 'none';
    overlay.style.display = 'none';
  } else {
    carrinhoElement.style.display = 'block';
    overlay.style.display = 'block';
  }

  carrinho.forEach(item => {
    const li = document.createElement('li');
    li.textContent = `${item.nome} (${item.tamanho}) - ${item.quantidade}x - R$ ${(item.preco * item.quantidade).toFixed(2)}`;

    const btnRemover = document.createElement('button');
    btnRemover.textContent = 'X';
    btnRemover.style.marginLeft = '10px';
    btnRemover.onclick = () => removerDoCarrinho(item.codigo);

    li.appendChild(btnRemover);
    listaCarrinho.appendChild(li);

    total += item.preco * item.quantidade;
  });

  totalSpan.textContent = total.toFixed(2);
}

function finalizarPedido() {
  if (carrinho.length === 0) {
    alert('Seu carrinho está vazio!');
    return;
  }

  // Aqui faça o envio para o backend
  alert('Pedido finalizado com sucesso!');
  carrinho = [];
  atualizarCarrinho();
}

// Evento fechar carrinho
document.getElementById('fechar-carrinho').onclick = () => {
  document.getElementById('carrinho').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
};
document.getElementById('overlay').onclick = () => {
  document.getElementById('carrinho').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
};

renderizarCardapio();