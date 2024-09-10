<!DOCTYPE html>
 <html>
   <head> 
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title>Check-in</title>     
   
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
        <h3>Realizar check-in</h3>
    
   <form action="/app/reserva/include/gCheckout.php" method="post" id="f">

   Número da reserva:<br/>
   <input type="text" name="idreserva" class="required"/><br/>

   Número de hospedes:<br/>
   <input type="text" name="hospedes" class="required"><br/>

   Forma de pagamento:<br/>
           <select name="pagamento">
                <option value="">Selecione</option>
                <option value="Credito">Credito</option>
                <option value="Debito">Debito</option>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Pix">PIX</option>
            </select><br/>
            <input type="submit" value="Enviar">
   </body>