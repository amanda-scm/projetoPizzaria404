<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>404Pizzaria - Home</title>
  <link rel="stylesheet" href="../css/style.css" />
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
    <section class="slider">
      <div class="quadro-imagens">
        <a href="delivery.php" target="_blank" title="Delivery">
          <img src="../png/1.png" class="slide ativo" />
        </a>
        <a href="">
          <img src="../png/2.png" class="slide" />
        </a>
        <a href="promocao.php" target="_blank" title="Promoções">
          <img src="../png/3.png" class="slide" />
        </a>
      </div>
    </section>
  </section>
</main>

    <section class="descricao">
      <div class="container-padrao">
        <div class="destaques-container">
          <div class="quadro-fixo">
            <img src="../png/11.png" alt="Ícone" class="icone-quadro" />
          </div>
          <div class="quadro-fixo">
            <img src="../png/12.png" alt="Ícone" class="icone-quadro" />
          </div>
        </div>
      </div>
    </section>

  <section class="cardapio">
    <div>
      <h2 class="titulo">CARDÁPIO</h2>
    
      <div class="botoes-categorias">
        <button data-categoria="tradicional">Tradicionais</button>
        <button data-categoria="especial">Especiais</button>
        <button data-categoria="doce">Doces</button>
      </div>
    
      <div class="cardapio-flex">
        <div class="sabores-coluna">
          <div class="lista-sabores">

            <div class="sabor-card tradicional">
              <img src="../png/marguerita.jpg" alt="Margherita" />
              <div class="info">
                <h3>Margherita</h3>
                <p>Molho pomodoro, mussarela, manjericão fresco.</p>
              </div>
            </div>
          
            <div class="sabor-card tradicional">
              <img src="../png/calabresa.jpg" alt="Calabresa" />
              <div class="info">
                <h3>Calabresa</h3>
                <p>Molho pomodoro, mussarela premium, calabresa e orégano.</p>
              </div>
            </div>
          
            <div class="sabor-card tradicional">
              <img src="../png/pizzaportuguesa.jpeg" alt="Portuguesa" />
              <div class="info">
                <h3>Portuguesa</h3>
                <p>Molho pomodoro, mussarela, presunto, ovo, tomate, pimentão, cebola, azeitona e orégano.</p>
              </div>
            </div>
          
            <div class="sabor-card tradicional">
              <img src="../png/fCatupiry.jpg" alt="Frango com Catupiry" />
              <div class="info">
                <h3>Frango com Catupiry</h3>
                <p>Molho pomodoro, mussarela, frango desfiado, catupiry e milho.</p>
              </div>
            </div>

            <div class="sabor-card especial">
              <img src="../png/frango.png" alt="Frango Especial" />
              <div class="info">
                <h3>Frango Especial</h3>
                <p>Molho pomodoro, mussarela, frango, bacon, cheddar e orégano.</p>
              </div>
            </div>
          
            <div class="sabor-card especial">
              <img src="../png/pizza4queijos.jpg" alt="Quatro Queijos" />
              <div class="info">
                <h3>Quatro Queijos</h3>
                <p>Mussarela, parmesão, provolone e gorgonzola.</p>
              </div>
            </div>
          
            <div class="sabor-card especial">
              <img src="../png/pizzapepperoni.jpg" alt="Pepperoni" />
              <div class="info">
                <h3>Pepperoni</h3>
                <p>Molho pomodoro, mussarela, pepperoni e pimenta calabresa.</p>
              </div>
            </div>
          
            <div class="sabor-card especial">
              <img src="../png/vegetariana.webp" alt="Vegetariana" />
              <div class="info">
                <h3>Vegetariana</h3>
                <p>Molho pomodoro, mussarela, tomate, cebola, pimentão, azeitona, brócolis e milho.</p>
              </div>
            </div>
          

            <div class="sabor-card doce">
              <img src="../png/pizzachocolatecommorango.jpg" alt="Chocolate com Morango" />
              <div class="info">
                <h3>Chocolate</h3>
                <p>Chocolate ao leite com morango e leite condensado.</p>
              </div>
            </div>
          
            <div class="sabor-card doce">
              <img src="../png/pizzaromeuejulieta.jpg" alt="Romeu e Julieta" />
              <div class="info">
                <h3>Romeu e Julieta</h3>
                <p>Goiabada cremosa com queijo mussarela.</p>
              </div>
            </div>
          
            <div class="sabor-card doce">
              <img src="../png/pizzabananacomcanela.webp" alt="Banana com Canela" />
              <div class="info">
                <h3>Banana com Canela</h3>
                <p>Banana fatiada, canela e açúcar.</p>
              </div>
            </div>
          
            <div class="sabor-card doce">
              <img src="../png/prestigio.jpg" alt="Prestígio" />
              <div class="info">
                <h3>Prestígio</h3>
                <p>Chocolate, coco ralado e leite condensado.</p>
              </div>
            </div>
            
          </div>
        </div>
        <div class="imagem-pizza">
          <img src="../png/pizzadestaque.png" alt="Pizza Destaque">
        </div>
    
      </div>
      
    </div>
  </section>
  </main>
  <script>
    // Verifica se o usuário está "logado" pelo localStorage (exemplo simples)
    const usuarioLogado = localStorage.getItem('usuarioLogado');
  
    if (usuarioLogado) {
      document.getElementById('link-login').style.display = 'none';
      document.getElementById('link-logout').style.display = 'inline';
    }
  </script>
  <script src="../js/java.js"></script>
  <script src="../js/cardapio.js"></script>
</body>
</html>