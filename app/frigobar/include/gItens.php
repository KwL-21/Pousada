<?php
   include($_SERVER['DOCUMENT_ROOT'].'/app/config/conexao.php');
   date_default_timezone_set('America/Sao_Paulo');

   $idfrigobar = $_POST['idfrigobar'];
   $nomeproduto = $_POST['nomeproduto'];
   $quantidade = $_POST['quantidade'];

   $sqlproduto = "SELECT * FROM produtos WHERE nome LIKE '{$nomeproduto}'";
   $resultproduto = mysqli_query($con, $sqlproduto);
   $row = mysqli_fetch_array($resultproduto);
   $idproduto = $row['idproduto'];

   $flag = 0;
   $msg = "";   

   $sqlfrigobar = "SELECT * FROM frigobar WHERE id like '{$idfrigobar}'";
   $resultfrigobar = mysqli_query($con, $sqlfrigobar);

   if (mysqli_num_rows($resultfrigobar) == 0) {
       $flag = 1;
       $msg = "Acomodação inexistente!";
   }

    $sqliprod = "SELECT * FROM produtos WHERE idproduto LIKE '{$idproduto}'";
    $resultprod = mysqli_query($con, $sqliprod);
    $row2 = mysqli_fetch_assoc($resultprod);
    $estoque = $row2['estoque'];

    if(mysqli_num_rows($resultprod) == 0){
        $flag = 1;
        $msg = "Produto inexistente";
    }

    
    if ($quantidade > $estoque){
        $flag = 1;
        $msg = "Estoque insuficiente, Quantidade disponivel:" .$estoque;
    }

    $sqlcapacidade = "SELECT * FROM frigobar WHERE id LIKE '{$idfrigobar}'";
    $resultcapacidade = mysqli_query($con, $sqlcapacidade);
    $row = mysqli_fetch_assoc($resultcapacidade);
    $capacidade = $row['capacidade'];


    if($quantidade > $capacidade){
        $flag = 1;
        $msg = "Frigobar não comporta a quantidade de produtos";
    }

    $iestoque = $estoque - $quantidade;

    if($flag == 0){
        
        $sql = "INSERT INTO estoque_frigobar (idfrigobar, idprodutos, quantidade) values('{$idfrigobar}','{$idproduto}', '{$quantidade}')";
         $sqlestoque = "UPDATE produtos SET saidas = '{$quantidade}', estoque = '{$iestoque}' WHERE idproduto = '{$idproduto}'";
        if(mysqli_query($con, $sql)){
            mysqli_query($con, $sqlestoque);
              $msg = "Gravado com sucesso!";
          }else{
              $msg = "Erro ao gravar!";
          }
          
      }
      
      echo $msg;
      mysqli_close($con);
?>
<br/>
<a href="/app/funcionarios/include/painel.php">Menu principal</a>