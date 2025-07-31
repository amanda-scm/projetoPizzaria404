CREATE DATABASE IF NOT EXISTS pizzaria404
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE pizzaria404;

CREATE TABLE IF NOT EXISTS Cliente (
    CPF VARCHAR(11) PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Telefone VARCHAR(15),
    Endereco VARCHAR(200),
    Email VARCHAR(100) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL,
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    AtualizadoEm DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- TABELA DE PEDIDOS
CREATE TABLE IF NOT EXISTS Pedido (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    DataHora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ValorTotal DECIMAL(10,2) DEFAULT 0.00,
    CPF_Cliente CHAR(11) NOT NULL,
    FOREIGN KEY (CPF_Cliente) REFERENCES Cliente(CPF) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- TABELA DE SABORES
CREATE TABLE IF NOT EXISTS Sabor (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(100) NOT NULL,
    Tipo ENUM('Salgado', 'Doce') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE DATABASE IF NOT EXISTS pizzaria404
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE pizzaria404;

-- CLIENTES COM LOGIN E SENHA
CREATE TABLE IF NOT EXISTS Cliente (
    CPF VARCHAR(11) PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Telefone VARCHAR(15),
    Endereco VARCHAR(200),
    Email VARCHAR(100) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL,
    CriadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    AtualizadoEm DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PEDIDOS
CREATE TABLE IF NOT EXISTS Pedido (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    DataHora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ValorTotal DECIMAL(10,2) DEFAULT 0.00,
    CPF_Cliente CHAR(11) NOT NULL,
    FOREIGN KEY (CPF_Cliente) REFERENCES Cliente(CPF) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- SABORES DISPONÍVEIS
CREATE TABLE IF NOT EXISTS Sabor (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(100) NOT NULL,
    Tipo ENUM('Salgado', 'Doce') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PIZZAS DISPONÍVEIS
CREATE TABLE IF NOT EXISTS Pizza (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(100) NOT NULL,
    Preco DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- RELAÇÃO ENTRE SABORES E PIZZAS
CREATE TABLE IF NOT EXISTS PizzaSabor (
    CodigoPizza INT,
    CodigoSabor INT,
    PRIMARY KEY (CodigoPizza, CodigoSabor),
    FOREIGN KEY (CodigoPizza) REFERENCES Pizza(Codigo) ON DELETE CASCADE,
    FOREIGN KEY (CodigoSabor) REFERENCES Sabor(Codigo) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PIZZAS ESCOLHIDAS EM UM PEDIDO
CREATE TABLE IF NOT EXISTS PizzaPedido (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    PedidoID INT NOT NULL,
    PizzaID INT NOT NULL,
    Quantidade INT NOT NULL DEFAULT 1,
    Preco DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (PedidoID) REFERENCES Pedido(Codigo) ON DELETE CASCADE,
    FOREIGN KEY (PizzaID) REFERENCES Pizza(Codigo) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- SABORES ESCOLHIDOS EM CADA PIZZA DO PEDIDO
CREATE TABLE IF NOT EXISTS PizzaPedidoSabor (
    PizzaPedidoID INT,
    SaborID INT,
    PRIMARY KEY (PizzaPedidoID, SaborID),
    FOREIGN KEY (PizzaPedidoID) REFERENCES PizzaPedido(Codigo) ON DELETE CASCADE,
    FOREIGN KEY (SaborID) REFERENCES Sabor(Codigo) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- DADOS INICIAIS DE SABORES
INSERT INTO Sabor (Nome, Tipo) VALUES 
('Mussarela', 'Salgado'),
('Calabresa', 'Salgado'),
('Frango com Catupiry', 'Salgado'),
('Quatro Queijos', 'Salgado'),
('Portuguesa', 'Salgado'),
('Chocolate', 'Doce'),
('Banana com Canela', 'Doce'),
('Romeu e Julieta', 'Doce'),
('Brigadeiro', 'Doce'),
('Prestígio', 'Doce');

-- DADOS INICIAIS DE PIZZAS
INSERT INTO Pizza (Nome, Preco) VALUES 
('Margherita', 30.00),
('Calabresa', 42.50),
('Quatro Queijos', 28.90),
('Frango com Catupiry', 44.00),
('Portuguesa', 35.00),
('Vegetariana', 27.00),
('Pepperoni', 45.50),
('Bacon', 38.00),
('Napolitana', 26.00),
('Moda da Casa', 49.90);