<?php
        include($_SERVER['DOCUMENT_ROOT'].'/app/config/conexao.php');
        date_default_timezone_set('America/Sao_Paulo');
        
    $email = $_POST["email"];
    $CPF = $_POST["cpf"];
    $login = $_POST["login"];
    $senha = md5($_POST["senha"]);
    $Perfil = $_POST["perfil"];
    
    
   
    $regraemail = "/^[a-zA-Z0-9.-_]+@[a-zA-Z0-9-]+\.[a-zA-Z.]+$/";
    
    $flag = 0;
    $msg = "";
    
    
    if(!preg_match($regraemail, $email)){
        $flag = 1;
        $msg = $msg. "<br/>Preencha o email corretamente!";
    }
    
    
    $sqlVerifica = "select 1 from funcionarios where login = '{$login}'";
    $resultVerifica = mysqli_query($con, $sqlVerifica);

    if (mysqli_num_rows($resultVerifica) == 1) {
        $flag = 1;
        $msg = "</br> Login já utilizado!";
    } 

    $sqlVerifica = "select 1 from funcionarios where CPF = '{$CPF}'";
    $resultVerifica = mysqli_query($con, $sqlVerifica);
    if (mysqli_num_rows($resultVerifica) == 1) {
        $flag = 1;
        $msg = "</br> Cliente já cadastrado!";
    } 

    if($perfil = ""){
        $flag = 1;
        $msg = "</br> Insira o tipo de perfil";
        
    }

    if($flag == 0){
        
       $sql = "INSERT INTO funcionarios (login, cpf, email, senha, perfil) values('{$login}','{$CPF}','{$email}','{$senha}','{$Perfil}')";
       if(mysqli_query($con, $sql)){
            $msg = "Gravado com sucesso!";
        }else{
            $msg = "Erro ao gravar!";
        }
        
    }
    
    echo $msg;
    mysqli_close($con);

?>
<br/>
<a href="/app/funcionarios/cadastrar.php">Cadastrar novo usuário</a>
<br/>
<a href="/app/funcionarios/include/painel.php">Painel de Controle</a>