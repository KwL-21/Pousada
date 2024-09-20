<?php
// Incluir a conexão com BD
include_once './conexao.php'; // Certifique-se de que a conexão está usando MySQLi
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Pesquisar e gerar excel</title>
</head>

<body>
    <h1>Pesquisar entre datas</h1>

    <?php
    // Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, [
        'data_inicio' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'data_final' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'PesqEntreData' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    // Apresentar o botão gerar excel somente quando o usuário pesquisar entre datas
    if (isset($dados['data_inicio']) && isset($dados['data_final'])) {
        echo "<a href='gerar_excel.php?data_inicio=" . $dados['data_inicio'] . "&data_final=" . $dados['data_final'] . "'>Gerar Excel</a><br><br>";
    }
    ?>

    <!-- Início do formulário pesquisar entre datas -->
    <form method="POST" action="">
        <label>Data de Inicio</label>
        <input type="date" name="data_inicio" value="<?php echo $dados['data_inicio'] ?? ''; ?>"><br><br>

        <label>Data final</label>
        <input type="date" name="data_final" value="<?php echo $dados['data_final'] ?? ''; ?>"><br><br>

        <input type="submit" value="Pesquisar" name="PesqEntreData"><br><br>
    </form>
    <!-- Fim do formulário pesquisar entre datas -->

    <?php
    // Verifica se o usuário clicou no botão
    if (!empty($dados['PesqEntreData'])) {
        // Conexão com o banco de dados usando MySQLi
        $conn = new mysqli('localhost', 'root', '92105393Oi!', 'datas');

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Preparar a QUERY para pesquisar entre datas
        $query_usuarios = "SELECT id, nome, email, endereco, created FROM usuarios WHERE created BETWEEN ? AND ?";
        
        // Preparar a consulta
        $stmt = $conn->prepare($query_usuarios);
        $stmt->bind_param('ss', $dados['data_inicio'], $dados['data_final']); // 'ss' indica que ambos os parâmetros são strings

        // Executar a consulta
        $stmt->execute();
        $result_usuarios = $stmt->get_result();

        // Verificar se encontrou algum registro
        if ($result_usuarios->num_rows > 0) {
            // Ler os registros que vêm do banco de dados
            while ($row_usuario = $result_usuarios->fetch_assoc()) {
                echo "ID: {$row_usuario['id']}<br>";
                echo "Nome: {$row_usuario['nome']}<br>";
                echo "E-mail: {$row_usuario['email']}<br>";
                echo "Endereço: {$row_usuario['endereco']}<br>";
                // Converter a data para o formato brasileiro
                echo "Cadastrado: " . date('d/m/Y H:i:s', strtotime($row_usuario['created'])) . "<br>";
                echo "<hr>";
            }
        } else { // Acessa o ELSE quando não encontrar nenhum registro
            echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>
