<?php
require_once 'config/config.php';
require_once 'class/CRUD.class.php';

$login = $_REQUEST['login'];
$senha = $_REQUEST['senha'];

if ($login == '') {
    echo "<h2> Por favor, digite o nome de usuário! </h2>";
} else if ($senha == '') {
    echo "<h2> Por favor, digite sua senha! </h2>";
} else {

$senha = md5($senha);
    
//SELECT
$select = $crud->select('COUNT(*)', 'login', 'WHERE nome = :nome AND senha = :senha')
               ->run([':nome' => $login, ':senha' => $senha]);
//foreach ( $select as $produto) {}
echo $produto = ($select >= 1) ? 'há registros' : 'não há registros';
    
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
}

            