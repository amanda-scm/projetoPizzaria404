<?php
session_start();
?>
<script>
  const estaLogado = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;
</script> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cardápio - 404Pizzaria</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/cardapio.css">
  <link rel="stylesheet" href="../css/carrinho.css">
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
      <h1>404Pizzaria</h1>
      <nav> 
        <a href="index.php">Início</a>
        <a href="promocao.php" class="ativo">Promoção</a>
        <a href="cardapio.php">Delivery</a>
        <a href="contato.php">Contato</a>
        <?php if (isset($_SESSION['usuario'])): ?>
      <span class="saudacao-usuario">Olá, <?php echo htmlspecialchars($_SESSION['usuario']['nome']); ?>!</span>
      <a href="../php/logout.php">Sair</a>

    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
    
    <form class="busca" onsubmit="buscarProduto(event)">
        <input type="text" id="campoBusca" placeholder="Buscar ..." />
    </form>
      
    <button class="cart-btn" onclick="toggleCarrinho()">
      🛒 <span id="contador-carrinho">0</span>
    </button>
  <main>
    <h1>Escolha sua Pizza</h1>
    <section class="sabores">
      <div id="form-sabores" >
        <div id="lista-sabores">
          <!-- sabores gerados via JS -->
          <div id="produtos" class="cardapio-grid"></div>
        </div>
      </div>
    </section>

    <div id="overlay" style="display:none;"></div>
    <aside id="carrinho" class="carrinho-lateral">
      <button id="fechar-carrinho" style="float:left;font-size:1.2em;margin-right:8px;">&times;</button>
      <h2 style="display:inline;">Carrinho</h2>
      <ul id="lista-carrinho"></ul>
      <p>Total: R$ <span id="total">0.00</span></p>
      <button class="botao-finalizar" onclick="finalizarPedido()">Finalizar Pedido</button>
    </aside>
  </main>
  <script>
    const estaLogado = <?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>;
  </script>
  <script src="../js/cardapio.js"></script>
</body>
</html>