<?php

    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'sistema_pedidos_gustavov';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn -> connect_error){
        die('Conexão falhou:' . $conn -> connect_error);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $nome_produto = $_POST['nome_produto'];
        $data = $_POST['data_entrega'];
        $sql = "INSERT INTO pedidos (nome, quantidade, nome_produto, data_entrega) VALUES ('$nome', '$quantidade', '$nome_produto', '$data')";
        if($conn -> query($sql) === true){
            echo "Novo registro adicionado!";
        } else {
            echo "Erro" . $sql . "<br>" . $conn -> error;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sql = "SELECT * FROM pedidos";
        $result = $conn -> query($sql);
        if($result -> num_rows > 0){
            echo "<table border='1'>
                <tr>
                    <th> ID </th>
                    <th> Nome </th>
                    <th> Pedido </th>
                    <th> Quantidade </th>
                </tr>";
            while($row = $result -> fetch_assoc()){
                echo "<table border='1'>
                <tr>
                    <td> {$row['id']} </td>
                    <td> {$row['nome']} </td>
                    <td> {$row['nome_produto']} </td>
                    <td> {$row['quantidade']} </td>
                </tr>"; 
            }
            echo "</table>";
        }else {
            echo "Nenhuma pessoa cadastrada";
        }
        
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
        <label for="data_entrega">Data atual:</label>
        <input type="date" name="data_entrega" required>
        <input type="submit" value="Realizar Pedido">
    </form>
</body>
</html>