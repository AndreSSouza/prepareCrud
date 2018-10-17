<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);
require_once 'config/config.php';
require_once 'class/CRUD.class.php';
$erro = 0;
$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

if (empty($login)) {
    $erro = "Por favor, digite o nome de usuário!";
} else if (empty($senha)) {
    $erro = "Por favor, digite sua senha!";
} else {

    $senha = md5($senha);

//SELECT
    $select = $crud->select('COUNT(*)', 'login', 'WHERE nome = :nome AND senha = :senha')
            ->run([':nome' => $login, ':senha' => $senha]);
    foreach ($select as $consultas) {
        //var_dump($produto);
    }
    $erro = ($consultas[0] >= 1) ? NULL : 'Usuário não encontrado';
}

    header("location:login.php?erro=$erro");


//    $consulta_login = "SELECT * FROM login WHERE nome_usuario = '$login' AND senha = '$password'";
//    $resultado_consulta_login = mysqli_query($conexao, $consulta_login);
//
//    if (mysqli_num_rows($resultado_consulta_login) > 0) {
//        while ($resultado_consulta_login_1 = mysqli_fetch_assoc($resultado_consulta_login)) {
//            $tipo_usuario = $resultado_consulta_login_1['tipo_usuario'];
//
//            if ($tipo_usuario == 'PROFESSOR') {
//                echo "<h2> Você não tem acesso a essa Pagina!! </h2>";
//            } else {
//                session_start();
//
//                $_SESSION['tipo_usuario'] = $tipo_usuario;
//
//                echo "<script language='javascript'> window.location='admin/fazer_chamada.php?pg=chamada'; </script>";
//            }
//        }
//    } else {
//        echo "<h2> Dados incorretos! </h2>";
//    }


            