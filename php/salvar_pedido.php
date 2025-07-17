<?php
include("conectar.php");

$cpf = $_POST['cpf'];
$valorTotal = $_POST['valor'];
$itens = json_decode($_POST['itens'], true);

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO Pedido (CPF_Cliente, ValorTotal) VALUES (?, ?)");
    $stmt->bind_param("sd", $cpf, $valorTotal);
    $stmt->execute();
    $pedidoID = $stmt->insert_id;

    foreach ($itens as $item) {
        $pizzaID = $item['codigo'];
        $quantidade = $item['quantidade'];
        $preco = $item['preco'];

        $stmt2 = $conn->prepare("INSERT INTO PizzaPedido (PedidoID, PizzaID, Quantidade, Preco) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("iiid", $pedidoID, $pizzaID, $quantidade, $preco);
        $stmt2->execute();
    }

    $conn->commit();
    echo "Pedido salvo com sucesso!";

} catch (Exception $e) {
    $conn->rollback();
    echo "Erro ao salvar pedido: " . $e->getMessage();
}

$conn->close();
?>