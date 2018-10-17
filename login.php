<?php
require_once 'config/config.php';
$erro = empty($_REQUEST['erro']) ? NULL : $_REQUEST['erro'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
        <title>Login</title>
        <link rel="stylesheet" href="css/estilo.css"/>
    </head>
    <body>
        <div id="logo">
            <img src="img/logoEtec.png" />
        </div>
        <div id="caixa_login"> 
<?php echo $mostra_erro = is_null($erro) ? NULL : '<h2>'.$erro.'</h2>'; ?>           
            <form name="form" method="post" action="valida_login.php">
                <table>                    
                    <tr>
                        <td>
                            <h1>Nome de Usuário:</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="login" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>Senha:</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="senha" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="input" type="submit" name="entrar" value="Entrar" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>