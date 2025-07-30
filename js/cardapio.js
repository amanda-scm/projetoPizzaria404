const pizzas = [
  { codigo: 1, nome: "Margherita", tamanho: "Grande", preco: 42.00, categoria: "Tradicional", imagem: "../mpng/1.png" },
  { codigo: 2, nome: "Calabresa", tamanho: "Grande", preco: 42.50, categoria: "Tradicional", imagem: "../mpng/2.png" },
  { codigo: 3, nome: "Portuguesa", tamanho: "Grande", preco: 45.00, categoria: "Tradicional", imagem: "../mpng/3.png" },
  { codigo: 4, nome: "Frango com Catupiry", tamanho: "Grande", preco: 44.00, categoria: "Tradicional", imagem: "../mpng/4.png" },
  { codigo: 5, nome: "Frango Especial", tamanho: "Grande", preco: 46.00, categoria: "Especial", imagem: "../mpng/5.png" },
  { codigo: 6, nome: "Quatro Queijos", tamanho: "Grande", preco: 43.90, categoria: "Especial", imagem: "../mpng/6.png" },
  { codigo: 7, nome: "Pepperoni", tamanho: "Grande", preco: 45.50, categoria: "Especial", imagem: "../mpng/7.png" },
  { codigo: 8, nome: "Vegetariana", tamanho: "Grande", preco: 43.00, categoria: "Especial", imagem: "../mpng/8.png" },
  { codigo: 9, nome: "Chocolate", tamanho: "Grande", preco: 39.90, categoria: "Doce", imagem: "../mpng/9.png" },
  { codigo: 10, nome: "Romeu e Julieta", tamanho: "Grande", preco: 39.00, categoria: "Doce", imagem: "../mpng/10.png" },
  { codigo: 11, nome: "Banana com Canela", tamanho: "Grande", preco: 37.90, categoria: "Doce", imagem: "../mpng/11.png" },
  { codigo: 12, nome: "Prestígio", tamanho: "Grande", preco: 40.00, categoria: "Doce", imagem: "../mpng/12.png" }
];

const listaCarrinho = document.getElementById('lista-carrinho');
const totalSpan = document.getElementById('total');
let carrinho = [];

function renderizarCardapio() {
  pizzas.forEach(pizza => {
    const card = document.createElement("div");
    card.className = "pizza-card";

    const imagemURL = pizza.imagem;

    card.innerHTML = `
      <img src="${imagemURL}" alt="Pizza ${pizza.nome}">
      <h3 class="pizza-nome">${pizza.nome}</h3>
      <p class="pizza-tamanho">${pizza.tamanho}</p>
      <p>Preço: R$ ${pizza.preco.toFixed(2)}</p>
      <button onclick="adicionarAoCarrinho(${pizza.codigo})">Adicionar ao carrinho</button>
    `;

    const categoriaContainer = document.getElementById(pizza.categoria.toLowerCase());
    if (categoriaContainer) {
      categoriaContainer.appendChild(card);
    }
  });
}

function buscarPizza(event) {
  event.preventDefault();
  const termo = document.getElementById('campoBusca').value.toLowerCase();
  const pizzasCards = document.querySelectorAll('.pizza-card');

  pizzasCards.forEach(card => {
    const nome = card.querySelector('.pizza-nome').innerText.toLowerCase();
    const tamanho = card.querySelector('.pizza-tamanho').innerText.toLowerCase();

    card.style.display = nome.includes(termo) || tamanho.includes(termo) ? 'block' : 'none';
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

  const contador = document.getElementById('contador-carrinho');
  const totalItens = carrinho.reduce((soma, item) => soma + item.quantidade, 0);
  contador.textContent = totalItens;

  localStorage.setItem('carrinho', JSON.stringify(carrinho));
}

function finalizarPedido() {
  if (carrinho.length === 0) {
    alert('Seu carrinho está vazio!');
    return;
  }

  alert('Pedido finalizado com sucesso!');
  carrinho = [];
  localStorage.removeItem('carrinho');
  atualizarCarrinho();
  ocultarCarrinho();
}

function exibirCarrinho() {
  document.getElementById('carrinho').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';
}

function ocultarCarrinho() {
  document.getElementById('carrinho').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
}

function toggleCarrinhoManual() {
  const carrinhoElement = document.getElementById('carrinho');
  const overlay = document.getElementById('overlay');
  const visivel = carrinhoElement.style.display === 'block';

  carrinhoElement.style.display = visivel ? 'none' : 'block';
  overlay.style.display = visivel ? 'none' : 'block';
}

document.addEventListener('DOMContentLoaded', function () {
  const carrinhoSalvo = localStorage.getItem('carrinho');
  if (carrinhoSalvo) {
    carrinho = JSON.parse(carrinhoSalvo);
    atualizarCarrinho();
  }

  renderizarCardapio();

  // Fechar carrinho com botão ×
  const btnFechar = document.getElementById('fechar-carrinho');
  if (btnFechar) btnFechar.onclick = ocultarCarrinho;

  // Fechar carrinho ao clicar fora
  const overlay = document.getElementById('overlay');
  if (overlay) overlay.onclick = ocultarCarrinho;

  // Abertura manual do carrinho
  const btnCarrinho = document.querySelector('.cart-btn');
  if (btnCarrinho) btnCarrinho.onclick = toggleCarrinhoManual;
});