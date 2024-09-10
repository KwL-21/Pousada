<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Parnaioca - Consumo</title>

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

       <form action="/app/frigobar/include/gConsumo.php" method="post" id="f">
           
        Nome acomodação:<br/>
        <input type="text" name="acomodacao" class="required"/><br/>

        Número da reserva:<br/>
        <input type="text" name="idreserva" class="required"/><br/>

        Nome do produto:<br/>
        <input type="text" name="produto" class="required"/><br/>

        ID do frigobar:<br/>
        <input type="text" name="idfrigobar" class="required"/><br/>

        Quantidade consumida:<br/>
        <input type="text" name="quantidade" class="required"/><br/>

        <input type="submit" value="Enviar"/>

       </form>
    </body>
</html>