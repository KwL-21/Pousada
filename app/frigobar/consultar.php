<?php
 include_once './validar.php';
?>

<!DOCTYPE html>
<html>
    <head>

       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
        <script>
            
            function excluir(mat){
                
                if(confirm('Deseja realmente excluir ?' )){
                    location.href='excluir.php?idusuario='+mat;
                }
                
            }
            
        </script>
        
        
    </head>
    <body>
             <h3>Consulta de Registro</h3>
        
        <form action="consultar_itens.php" method="get">
            
            Nome:
            <input type="text" name="idfrigobar"/>
            <input type="submit" value="Buscar" />
            
        </form>
        
        <hr/>
        
        <?php
            if(!empty($_GET["idfrigobar"])){
               $login = $_GET["idfrigobar"];
               
               include_once './conexao.php';
               
               $sql = "select * from estoque_frigobar where idfrigobar like '{$login}'";
               $result = mysqli_query($con, $sql);
               $totalregistros = mysqli_num_rows($result);
               
               if($totalregistros > 0){

                   ?>
                    <table width="900px" border="1px">  
                        <tr>
                            <th>id do frigobar</th>
                            <th>id do item</th>
                            <th>quantidade no frigobar</th>
                        </tr>                                                
                   <?php
                
                   while($row = mysqli_fetch_array($result)){
                        $idfrigobar = $row['id'];
                

                       ?>
                        
                        <tr>
                            <td><?php echo $row["idfrigobar"]?></td>
                            <td><?php echo $row["idprodutos"]?></td>
                            <td><?php echo $row["quantidade"]?></td>
                        </tr>
                        
                        <?php
                   }                   
                   echo "</table>";
                   ?>
                   </table>
                   <?php
                   
                   echo "Total de registros: ".$totalregistros;
                   
               }else{
                   echo "Nenhum registro encontrado!";
               }               
               
               mysqli_close($con);
               
            }
        ?>
        <hr/>
        <a href="/app/funcionarios/include/painel.php">Pagina Inicial</a>
    </body>
</html>
