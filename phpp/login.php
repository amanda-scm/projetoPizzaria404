<?php
session_start(); 
include("canectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Cliente WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Comparação direta porque as senhas não estão criptografadas
        if ($senha === $usuario['Senha']) {
            // ✅ Guarda os dados na sessão
            $_SESSION['usuario'] = [
                'cpf' => $usuario['CPF'],
                'nome' => $usuario['Nome'],
                'email' => $usuario['Email']
            ];

            echo "<script>
                alert('Login realizado com sucesso!');
                window.location.href = '../html/index.html';
            </script>";
            exit;
        } else {
            echo "<script>alert('Senha incorreta.');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>