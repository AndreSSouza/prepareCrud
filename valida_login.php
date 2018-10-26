<?php

header("Content-Type: text/html; charset=utf-8", true);
require_once 'class/config.class.php';
//require_once 'class/CRUD.class.php';

$erro = NULL;
$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

if (empty($login)) {
    $erro = "Por favor, digite o nome de usuário!";
} else if (empty($senha)) {
    $erro = "Por favor, digite sua senha!";
} else {

    $senha = md5($senha);

    $select = $crud->select('COUNT(*) quantidade, tipo_usuario tipo', 'login', 'WHERE nome_usuario = :login AND senha = :senha')
            ->run([':login' => $login, ':senha' => $senha]);

    $valores = $select->fetch(PDO::FETCH_ASSOC);
    $erro = ($valores['quantidade'] >= 1) ? NULL : 'Usuário não encontrado';
}
if (!is_null($erro)) {
    header("location:login.php?erro=$erro");
}
if ($valores['tipo'] == 'ADMINISTRADOR') {
    echo 'Você está logado com uma conta administrador';
} else {
    echo 'Você está logado com uma conta professor';
}
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
//
//$select = $crud->select('*', 'produtos')->run();
//
//while ($result = $select->fetch(PDO::FETCH_ASSOC)){
//    var_dump($result);
//    echo 'Preço'.$result['preco'];
//}
//
//var_dump($result);
//
////print("PDO::FETCH_BOTH: ");
////print("Return next row as an array indexed by both column name and number\n");
//$result = $select->fetch(PDO::FETCH_BOTH);
////print_r($result);
//
//
//var_dump($result);

            