<?php 
include($_SERVER['DOCUMENT_ROOT'].'/app/config/conexao.php');
include($_SERVER['DOCUMENT_ROOT'].'/app/config/validar.php');

if($_SESSION["perfil"] == "u"){
 header("Location:Parnaioca/painel.php");
 die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Parnaioca - Acomodação</title>

        <noscript>
        <meta http-equiv="refresh" content="0; url=noscript.php"/>
        </noscript>

        <script src="/app/assets/js/jquery.min.js"></script>
        <script src="/app/assets/js/jquery.validate.js"></script>
        <script src="/app/assets/js/maskedinput-1.1.2.pack.js"></script>
        
        <script>        
        $(document).ready(function(){
            $("#f").validate(); 
            $("#cpf").mask("999.999.999-99");
            $("#nascimento").mask("99/99/9999");
        }
    ); 
    
        </script>
        
        <style>
            label.error{
                color: red;
                font-size: 12px;
                margin-left: 5px;
            }
        </style>

    </head>
    <body>
        <?php
            $acomodacao = $_GET["IDacomodacoes"];
                
            $sql = "select * from acomodacoes where idacomodacoes like '{$acomodacao}'";          
            $result = mysqli_query($con, $sql);            
            $row = mysqli_fetch_array($result);
            $acomodacao = $row['idacomodacoes'];
                   
                  ?>        
        <h3>Editar Acomodações</h3>

        <form action="/app/acomodacoes/include/aAcomodacoes.php" method="post" id="f">            
            
        <input type="hidden" readonly="true" name="idacomodacoes" value="<?php echo $row["idacomodacoes"] ?>" />
                     
            Acomodação:<br/>
            <input type="text" name="nome" class="required"><br/>

            Valor da Acomodação:<br/>
            <input type="text" name="valor" class="required"/> <br/>

            Capacidade:<br/>
            <input type="text" name="capacidade" class="required"/><br/> 

            Tipo de Acomodação:<br/>
            <select name="tipo"></br>   
               <option value="">Selecione</option>
               <option value="s">Suite</option>
               <option value="a">Apartamento</option>
            </select> <br/>
            
            <input type="submit" value="Enviar" />
            
        </form>        
        
    </body>
</html>
