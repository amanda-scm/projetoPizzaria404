<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // Redireciona se não estiver logado
    header("Location: login.php");
    exit;
}
include("canectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $pizzas = $_POST['pizzas'];
    $sqlPedido = "INSERT INTO Pedido (CPF_Cliente) VALUES (?)";
    $stmtPedido = $conn->prepare($sqlPedido);
    $stmtPedido->bind_param("s", $cpf);

    if (!$stmtPedido->execute()) {
        die("Erro ao criar pedido: " . $stmtPedido->error);
    }

    $pedidoID = $stmtPedido->insert_id;
    $stmtPedido->close();

    $valorTotal = 0;

    foreach ($pizzas as $pizza) {
        $pizzaID = $pizza['id'];
        $quantidade = $pizza['quantidade'];
        $preco = $pizza['preco'];
        $sabores = $pizza['sabores']; // array de id_sabor

        $sqlPizza = "INSERT INTO PizzaPedido (PedidoID, PizzaID, Quantidade, Preco)
                     VALUES (?, ?, ?, ?)";

        $stmtPizza = $conn->prepare($sqlPizza);
        $stmtPizza->bind_param("iiid", $pedidoID, $pizzaID, $quantidade, $preco);
        $stmtPizza->execute();
        $pizzaPedidoID = $stmtPizza->insert_id;
        $stmtPizza->close();

        // Insere sabores
        foreach ($sabores as $saborID) {
            $sqlSabor = "INSERT INTO PizzaPedidoSabor (PizzaPedidoID, SaborID)
                         VALUES (?, ?)";

            $stmtSabor = $conn->prepare($sqlSabor);
            $stmtSabor->bind_param("ii", $pizzaPedidoID, $saborID);
            $stmtSabor->execute();
            $stmtSabor->close();
        }

        $valorTotal += $preco * $quantidade;
    }

    // Atualiza o valor total do pedido
    $sqlAtualiza = "UPDATE Pedido SET ValorTotal = ? WHERE Codigo = ?";
    $stmtAtualiza = $conn->prepare($sqlAtualiza);
    $stmtAtualiza->bind_param("di", $valorTotal, $pedidoID);
    $stmtAtualiza->execute();
    $stmtAtualiza->close();

    echo "Pedido salvo com sucesso!";
}

$conn->close();
?>