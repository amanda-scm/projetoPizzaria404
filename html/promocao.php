<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promoções - 404Pizzaria</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/promocao.css">
  <link rel="stylesheet" href="../css/carrinho.css">
  <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
</head>

<body>
  <div id="overlay" style="display: none;"></div>

  <aside id="carrinho" class="carrinho-lateral" style="display: none;">
    <button id="fechar-carrinho" style="float:left;font-size:1.2em;margin-right:8px;">&times;</button>
    <h2 style="display:inline;">Carrinho</h2>
    <ul id="lista-carrinho"></ul>
    <p>Total: R$ <span id="total">0.00</span></p>
    <button class="botao-finalizar" onclick="finalizarPedido()">Finalizar Pedido</button>
  </aside>
  
  <header>
    <div class="logo-container"> 
      <a href="index.php">
        <img src="../png/logo.png" alt="Logo da Pizzaria404" class="logo"  />
      </a>
    </div>
    <nav>
      <a href="index.php">Início</a>
      <a href="promocao.php" class="ativo">Promoção</a>
      <a href="delivery.php">Delivery</a>
      <a href="contato.php">Contato</a>

      <?php if (isset($_SESSION['usuario'])): ?>
        <div class="usuario-logado">
          <span class="saudacao-usuario">Olá, <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?>!</span>
          <a href="../php/logout.php" class="logout-link">Sair</a>
        </div>
      <?php else: ?>
        <a href="login.php" class="login-link">Login</a>
      <?php endif; ?>

      <form class="busca" onsubmit="buscarProduto(event)">
        <input type="text" id="campoBusca" placeholder="Buscar ..." />
      </form>
      
      <button class="cart-btn" onclick="toggleCarrinho()">
        🛒 <span id="contador-carrinho">0</span>
      </button>
    </nav>
  </header>

  <main>
    <section class="promocoes">
      <h2>Promoções Especiais</h2>

      <div class="promocao-card">
        <h3>Promoção da Semana</h3>
        <p>Pizza Calabresa com 20% de desconto!</p>
        <p><strong>R$ 34,00</strong> CUPOM: ERRO404</p>
      </div>

      <div class="promocao-card">
        <h3>Sabor Especial</h3>
        <p>Frango com Catupiry pela metade do preço!</p>
        <p><strong>R$ 22,00</strong> CUPOM: ERRO404</p>
      </div>

    </section>
  </main>

  <script src="../js/java.js"></script>
  <script src="../js/cardapio.js"></script>
  <script>
    const usuarioLogado = localStorage.getItem('usuarioLogado');
  
    if (usuarioLogado) {
      document.getElementById('link-login').style.display = 'none';
      document.getElementById('link-logout').style.display = 'inline';
    }
  </script>
</body>
</html>