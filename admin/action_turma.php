<?php

header("Content-Type: text/html; charset=utf-8", true);
require_once '../class/config.class.php';

$nome_turma = empty(trim($_POST['nome_turma'])) ? NULL : trim($_POST['nome_turma']);
$qtde_alunos = empty(trim($_POST['qtde_alunos'])) ? NULL : trim($_POST['qtde_alunos']);
$msg = NULL;

if (is_null($nome_turma) || is_null($qtde_alunos)) {
    header("Location: turma.php?msg=nem o nome da turma nem a quantidade de alunos podem ser nulos");
    exit();
}

$select = $crud->select('COUNT(*) quantidade', 'turma', 'WHERE nome_turma = :turma')
               ->run([':turma' => $nome_turma]);

$valores = $select->fetch(PDO::FETCH_ASSOC);
$erro = ($valores['quantidade'] >= 1) ? 'Erro Ao Cadastrar Turma (' . $nome_turma . ') já Existe!' : NULL;

//se clicar no botão cadastrar executa isso
if (isset($_REQUEST['cadastra_turma'])) {
    if (!is_null($erro)) {
        header("Location: turma.php?msg=$erro");
    } else {
        $insert_turma = $crud->insert('turma', 'nome_turma, quantidade_alunos', '(:nome, :qtde)')
                ->run([':nome' => $nome_turma, ':qtde' => $qtde_alunos]);
        if ($insert_turma->rowCount() <= 0) {
            $msg = 'Erro ao Cadastrar, Turma já Cadastrada!';
        } else {
            $msg = 'Cadastro Realizado com sucesso!';
        }
        header("location:turma.php?msg=$msg");
    }
} 


