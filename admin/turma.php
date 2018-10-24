<?php
require "topo.php";
$alert = empty($_REQUEST['msg']) ? NULL : $_REQUEST['msg'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8" />
        <title>Turma</title>
        <link rel="stylesheet" href="css/estilo.css" type="text/css"/>
    </head>    
    <body>
        <?php
        //echo "<script language='javascript'> window.alert('Atualizado com Sucesso'); window.location='estudantes.php?pg=espera';</script>";
        echo "<script lang='javascript'> alert('$alert');</script>";
        //echo $mostra_erro = is_null($alert) ? NULL : $alert ;
        ?>
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

