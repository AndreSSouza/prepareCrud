<?php
require_once 'config/config.php';
$erro = empty($_REQUEST['erro']) ? NULL : $_REQUEST['erro'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8" />
        <title>Turma</title>
        <link rel="stylesheet" href="css/estilo.css" type="text/css"/>
    </head>
    <body>
        <?php require "topo.php"; ?>
        <div id="box_curso">            
            <h1>Cadastrar turma</h1>
            <form name="formTurma" method="post" action="action_turma.php">
                <table width="900" border="0">
                    <tr>
                        <td>
                            Nome da turma: <input type="text" name="nome_turma" id="textfield" maxlength="2">
                            <br/><br/>
                            Quantidade de alunos: <input type="number" name="qtde_alunos" id="textfield" min="1">
                            <br/><br/>
                            <input class="input" type="submit" name="cadastra_turma" id="button" value="Cadastrar">
                        </td>
                    </tr>
                </table>
            </form>
            <br/>            
        </div>
    </body>
</html>

