<?php
include_once './conexao.php';

$data_inicio = filter_input(INPUT_GET, 'data_inicio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$data_final = filter_input(INPUT_GET, 'data_final', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($data_inicio && $data_final) {
    $query_usuarios = "SELECT id, nome, email, endereco 
                        FROM usuarios
                        WHERE created BETWEEN ? AND ?";

    $stmt = $conn->prepare($query_usuarios);
    $stmt->bind_param('ss', $data_inicio, $data_final); 

    $stmt->execute();
    $result_usuarios = $stmt->get_result();

    if ($result_usuarios->num_rows > 0) {
        header('Content-Type: text/csv; charset=utf-8');

        header('Content-Disposition: attachment; filename=arquivo.csv');

        $resultado = fopen("php://output", 'w');

        $cabecalho = ['id', 'Nome', 'E-mail', mb_convert_encoding('Endereço', 'ISO-8859-1', 'UTF-8')];

        fputcsv($resultado, $cabecalho, ';');

        while ($row_usuario = $result_usuarios->fetch_assoc()) {
            array_walk_recursive($row_usuario, 'converter');

            fputcsv($resultado, $row_usuario, ';');
        }

        fclose($resultado);
    } else {
        echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p style='color: #f00;'>Erro: Datas inválidas!</p>";
}

function converter(&$dados_usuario){
    $dados_usuario = mb_convert_encoding($dados_usuario, 'ISO-8859-1', 'UTF-8');
}
?>
