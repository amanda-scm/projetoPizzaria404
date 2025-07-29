<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - 404Pizzaria</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/carrinho.css">

  <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
</head>
<body> 
  <form action="../php/cadastro.php" method="post">
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
    <section class="login-container">
      <h2>Cadastro</h2>
      <form action="../php/cadastro.php" method="post" aria-label="Formulário de cadastro">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>

        <label for="CPF">CPF</label>
        <input type="number" name="CPF" id="CPF" placeholder="Digite seu CPF" required>
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Digite seu email" required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Crie uma senha" required>

        <label for="confirmar">Confirmar Senha</label>
        <input type="password" name="confirmar" id="confirmar" placeholder="Repita a senha" required>

        <button type="submit">Cadastrar</button>
      </form>
      <p><a href="login.html">Já tem uma conta? Faça login</a></p>
    </section>
  </main>
  <script>
   
  </script>
</body>
</html>