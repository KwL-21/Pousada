<?php 
include($_SERVER['DOCUMENT_ROOT'].'/app/config/conexao.php');
include($_SERVER['DOCUMENT_ROOT'].'/app/config/validar.php');

date_default_timezone_set('America/Sao_Paulo');

$IDacomodacoes = $_POST['idacomodacoes'];
$acomodacoes = $_POST["nome"];
$Valoracomodacao = $_POST["valor"];
$capacidade = $_POST["capacidade"];
$Tipoacomodacao = $_POST["tipo"];


    
    $sql = "update acomodacoes set 
            nome = '{$acomodacoes}', valor = '{$Valoracomodacao}', capacidade = '{$capacidade}', tipo = '{$Tipoacomodacao}'
            where idacomodacoes like '{$IDacomodacoes}'";
                 
    if(mysqli_query($con, $sql)){
        echo "Dados atualizados com sucesso!";
        
        
            //Criando Log de Operação "Gravado com Sucesso"
           $log= fopen("Editados.txt", "a+");
            //escreve no arquivo
            fwrite($log, "Editado em: ".date("d/m/Y"). " as ".date("H:i:s"));
            fwrite($log,"\nEditados Por:" .$_SESSION["login"]);
            fwrite($log, "\n----------------------------\n\n");
            
            //fecha o arquivo
            fclose($log);
        
    }else{
        echo "Erro ao atualizar!";
    }
    mysqli_close($con);

    // voltar para a pagina anterior automaticamente
?>
<br/>
<a href="/app/funcionarios/include/painel.php">Painel</a>
