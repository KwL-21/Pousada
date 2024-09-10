<?php 
date_default_timezone_set('America/Sao_Paulo');
 include($_SERVER['DOCUMENT_ROOT'].'/app/config/validar.php');
 include($_SERVER['DOCUMENT_ROOT'].'/app/config/conexao.php');

 if($_SESSION["perfil"] == "u"){
    header("Location:Parnaioca/painel.php");
    die();
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
<?php

    $idacomodacoes = $_GET["IDacomodacoes"];
   
    
    $sql = "delete from acomodacoes where idacomodacoes = ".$idacomodacoes;
    
    if(mysqli_query($con, $sql)){
        echo "Deletado com sucesso Srº (ª) ".$_SESSION ["login"];
        
            //Criando Log de Operação "Gravado com Sucesso"
           $log= fopen("deletados.txt", "a+");
            //escreve no arquivo
            fwrite($log, "Excluido em: ".date("d/m/Y"). " as ".date("H:i:s"));
            fwrite($log,"\nDeletado Por:" .$_SESSION["login"]);
            fwrite($log, "\n----------------------------\n\n");
            
            //fecha o arquivo
            fclose($log);
        
        
        
        }else{
        echo "Erro ao deletar!";
    }
    mysqli_close($con);

    ?>
<br/>
<a href="/app/funcionarios/include/painel.php">Voltar para o Painel</a>

    
</body>
</html>