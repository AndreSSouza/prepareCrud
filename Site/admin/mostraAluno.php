<?php
require "../class/config.class.php";

// get the q parameter from URL
$nome = intval($_GET['nome']);

if ($nome == '') {
    ?>

    <input type="text" disabled="disabled" value="">

    <?php
} else {

    $select_nome_aluno = $crud->select('nome_aluno', 'inscricao', 'WHERE id_inscricao = ?')->run([$nome]);
    //$sql_consulta_nome_aluno = "SELECT nome_aluno FROM inscricao WHERE id_inscricao = '" . $q . "'";
    //$consulta_nome_aluno = mysqli_query($conexao, $sql_consulta_nome_aluno) or die(mysqli_error($conexao));

    if ($select_nome_aluno->rowCount() <= 0) {
        ?>

        <input type="text" disabled="disabled" value="Aluno não encontrado!">

    <?php
    } else {

        $val_nome_aluno = $select_nome_aluno->fetch(PDO::FETCH_ASSOC);
        //$resultado_consulta_busca_nome_valores = mysqli_fetch_assoc($consulta_nome_aluno);
        ?>
        <input type="text" disabled="disabled" value="<?php echo $val_nome_aluno['nome_aluno']; ?>">

    <?php
    }
}
?>