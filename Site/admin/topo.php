<?php
$usuario_atual = "ADMINISTRADOR";
require '../class/config.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />     
        <link href="css/topo.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
        <script src="../js/lightbox.js"></script>
        <link href="../css/lightbox.css" rel="stylesheet" />
        <link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="../jquery.superbox-min.js"></script>
        <script type="text/javascript">
            $(function () {
                $.superbox.settings = {
                    closeTxt: "Fechar",
                    loadTxt: "Carregando...",
                    nextTxt: "Next",
                    prevTxt: "Previous"
                };
                $.superbox();
            });
        </script>   
    </head>
    <body bgcolor="#000">        
        <div id="logo">
            <img src="../img/logoEtec.png" width="100px" height="144px" style="background-color: #2c82ce;"/>
        </div>         
        <div id="box_menu">
            <div id="menu_topo">
                <ul>   				
                    <li><a href="fazer_chamada.php">CHAMADA</a></li>   				
                    <li><a href="cursos_e_disciplinas.php?pg=turma">TURMAS</a></li>
                    <li>
                        <a href="#">PROFESSORES</a>
                        <ul>
                            <li>
                                <a href="professores.php?pg=professor">Professores</a>
                            </li>
                            <li>
                                <a href="professores.php?pg=disciplina">Disciplinas</a>
                            </li>
                            <li>
                                <a href="professores.php?pg=disciplinas_ministradas">Professores & Disciplinas</a>
                            </li>
                        </ul>
                    </li>   				
                    <li>
                        <a href="#">ESTUDANTES</a>
                        <ul>
                            <li>
                                <a href="estudantes.php?pg=espera">Lista Espera</a>
                            </li>
                            <li>
                                <a href="estudantes.php?pg=aluno">Alunos</a>
                            </li>						
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>