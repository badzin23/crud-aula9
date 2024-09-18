<?php

    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'sistema_pedidos_gustavov';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn -> connect_error) {
        die('Conexão falhou: ' . $conn -> connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_cliente = $_POST['nome_cliente'];
        $nome_produto = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $data_pedido = $_POST['data_pedido'];

        $sql = "INSERT INTO pedidos (nome_cliente, nome_produto, quantidade,data_pedido) VALUES ('$nome_cliente', '$nome_produto', '$quantidade', '$data_pedido')";

        if ($conn->query($sql) === true) {
            echo "Novo registro adicionado!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn -> error;
        }
    }

    $sql = "SELECT * FROM pedidos";
    $result = $conn -> query($sql);


    if ($result -> num_rows > 0) {
        echo "<table border='1'>
            <tr>
                <th>nome_cliente</th>
                <th>nome_produto</th>
                <th>quantidade</th>
                <th>data_pedido</th>
                <th>Ações</th>
            </tr>";
        while ($row = $result -> fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nome_cliente']}</td>
                    <td>{$row['nome_produto']}</td>
                    <td>{$row['quantidade']}</td>
                    <td>{$row['data_pedidos']}</td>
                    <td>
                        <a href='update.php?id={$row['id']}'>Editar</a> |
                        <a href='delete.php?id={$row['id']}'>Excluir</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum registro encontrado.";
    }

   
    $conn -> close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pedidos</title>
</head>
<body>
    <form method="POST">
        <label for="nome">Nome completo:</label>
        <input type="text" name="nome" required>
        <label for="quantidade">Quantidade de itens:</label>
        <input type="text" name="quantidade" required>
        <label for="nome_produto">Nome do item:</label>
        <input type="text" name="nome_produto" required>
        <label for="data">Data atual:</label>
        <input type="date" name="data" required>
        <input type="submit" value="Realizar Pedido">
    </form>
</body>
</html>
