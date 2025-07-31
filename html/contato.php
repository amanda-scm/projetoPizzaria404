<?php
session_start();

?>

<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404Pizzaria - Home</title>
  <link rel="stylesheet" href="../css/contato.css">
  <link rel="stylesheet" href="../css/style.css">
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
  
  <section class="contato-section">
    <div class="contato-wrapper">
      <h2>Fale Conosco</h2>
      <p>Quer pedir nossas pizzas ou falar com a gente? Use o telefone ou preencha o formulário abaixo.</p>
  
      <div class="contato-info">
        <div class="contato-item">
          <h3>Telefones</h3>
          <p>(21) 2042‑4949<br>(21) 99979‑3589</p>
        </div>
  
        <form class="contato-form" onsubmit="event.preventDefault(); alert('Enviado!')">
          <input type="text" name="nome" placeholder="Seu nome" required />
          <input type="email" name="email" placeholder="Seu e‑mail" required />
          <textarea name="mensagem" rows="4" placeholder="Sua mensagem..." required></textarea>
          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </section>
  <script>
    const estaLogado = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;
  </script>
  <script src="../js/java.js"></script>
  <script src="../js/cardapio.js"></script>
  
</html>