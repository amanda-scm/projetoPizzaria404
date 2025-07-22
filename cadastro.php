<?php
include("canectar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $CPF = $_POST["CPF"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar = $_POST["confirmar"];

    if ($senha !== $confirmar) {
        echo "<script>
            alert('Erro: As senhas não coincidem.');
            window.history.back();
        </script>";
        exit;
    }

    $senhaPura = $senha;

    $sql = "INSERT INTO Cliente (Nome, CPF, Email, Senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $CPF, $email, $senhaPura);

    if ($stmt->execute()) {
        echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href = '../html/index.html';
        </script>";
    } else {
        if ($conn->errno === 1062) {
            echo "<script>
                alert('Erro: Este e-mail ou CPF já está cadastrado.');
                window.history.back();
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar: " . addslashes($conn->error) . "');
                window.history.back();
            </script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>