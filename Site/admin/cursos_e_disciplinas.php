<?php require "topo.php"; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Turmas</title>
        <!--<link rel="stylesheet" type="text/css" href="css/cursos_e_disciplinas.css"/>-->
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>	
        <!CADASTRAR TURMAS>

        <?php if (@$_GET['pg'] == 'turma') { ?>
            <div id="box_curso">

                <!VISUALIZAR ALUNOS DA TURMA ESCOLHIDA>

                <?php if (@$_GET['op'] == 'visualizar') { ?>

                    <?php
                    $cod_turma = $_GET['turma'];
                    $select_turma = $crud->select('id_turma, nome_turma, quantidade_alunos, disponivel', 'turma', 'WHERE id_turma = ?')->run([$cod_turma]);
                    $valores_turma = $select_turma->fetch(PDO::FETCH_ASSOC);
                    $nome_turma = $valores_turma['nome_turma'];
                    $quantidade_alunos = $valores_turma['quantidade_alunos'];
                    $disponivel = $valores_turma['disponivel'];
                    ?>

                    <br/>
                    <table width="900">
                        <tr>
                            <td>
                                <center>Turma:
                                    <input type="text" style="width:30px" disabled value="<?php echo $nome_turma; ?>"></input>
                                </center>
                            </td>
                            <td>
                                <center>Quantidade de alunos:
                                    <input type="text" style="width:30px" disabled value="<?php echo $quantidade_alunos; ?>"></input>
                                </center>
                            </td>
                            <td>
                                <center>Status da turma:
                                    <input type="text" style="width:85px" disabled value="<?php echo $disponivel ? 'Disponível' : 'Indisponível'; ?>"></input>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <br/>

                    <table width="900" border="0">
                        <tr>
                            <td width="710"><strong>Nome do aluno</strong></td>
                            <td><strong>Quantidade de faltas</strong></td>
                        </tr>
                        <?php
                        $select = $crud->select('i.nome_aluno AS nome, a.id_aluno AS id_aluno', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao INNER JOIN matricula m ON m.id_aluno = a.id_aluno WHERE m.id_turma = ?')->run([$cod_turma]);
                        while ($values_select = $select->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td width="710"><?php echo $values_select['nome']; ?></td>
                                <td>
                                    <center>
                                        <?php
                                        $cod_aluno = $values_select['id_aluno'];
                                        $select_faltas = $crud->select('COUNT(presenca) AS faltas', 'chamada', 'WHERE id_aluno = ? AND presenca = 0')->run([$cod_aluno]);
                                        $val_total_faltas = $select_faltas->fetch(PDO::FETCH_ASSOC);
                                        echo $val_total_faltas['faltas'];
                                        ?>
                                    </center>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br/>
                    <?php
                    die;
                }
                ?>

                <!>

                <!Editando a turma>

                <?php if (@$_GET['op'] == 'atualizar') { ?>

                    <?php
                    $cod_turma = $_GET['turma'];
                    $select_turma_alt = $crud->select('nome_turma, quantidade_alunos', 'turma', 'WHERE id_turma = ?')->run([$cod_turma]);
                    $val_turma_alt = $select_turma_alt->fetch(PDO::FETCH_ASSOC);
                    $nome_turma = $val_turma_alt['nome_turma'];
                    $quantidade_alunos = $val_turma_alt['quantidade_alunos'];

                    if (isset($_POST['salvar'])) {

                        $nome_turma_post = $_POST['nome_turma'];
                        $quantidade_alunos_post = $_POST['qtde_alunos'];

                        if (($nome_turma != $nome_turma_post) || ($quantidade_alunos != $quantidade_alunos_post)) {

                            $update_turma = $crud->update('turma', 'nome_turma = :nome, quantidade_alunos = :qtde', 'WHERE id_turma = :id_turma')->run([':nome' => $nome_turma_post, ':qtde' => $quantidade_alunos_post, ':id_turma' => $cod_turma]);
                            echo "<script language='javascript'> window.alert('Turma atualizada com Sucesso'); window.location='cursos_e_disciplinas.php?pg=turma';</script>";
                        }
                    }
                    ?>

                    <form method="post">
                        <table width="900" border="0">
                            <tr>
                                <td colspan="2"><center><strong><i>Atualizar turma</i></i></strong></center></td>
                            </tr>
                            <tr>
                                <td width="134" >
                                    Nome da turma
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nome_turma" id="textfield" value="<?php echo $nome_turma; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td width="134">
                                    Quantidade de alunos
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="qtde_alunos" id="textfield" min="1" value="<?php echo $quantidade_alunos; ?>">
                                </td>
                                <tr>
                                    <td><center><input class="input" type="submit" name="salvar" value="Salvar"/> <a class="a2" href="cursos_e_disciplinas.php?pg=turma">Cancelar</a></center></td>
                                </tr>
                        </table>
                    </form>
                    <?php
                    die;
                }
                ?>
                <!>

                <!DELEÇÃO DAS TURMAS>

                <?php
                if (@$_GET['op'] == 'deletar') {

                    $cod_turma = $_GET['turma'];
                    $crud->delete('turma', 'WHERE id_turma = ?')->run([$cod_turma]);
                }
                ?>

                <!CADASTRANDO NOVAS TURMAS>

                <?php if (@$_GET['cadastra'] == 'sim') { ?>                    
                    <h1>Cadastrar turma</h1>
                    <?php
                    if (isset($_POST['cadastra_turma'])) {

                        $nome_turma = $_POST['nome_turma'];
                        $qtde_alunos = $_POST['qtde_alunos'];

                        $insert_turma = $crud->insert('turma', 'nome_turma, quantidade_alunos', '(:nome, :qtde)')->run([':nome' => $nome_turma, ':qtde' => $qtde_alunos]);

                        if ($insert_turma->rowCount() <= 0) {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar, Turma já Cadastrada!');</script>";
                        } else {
                            echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
                            echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=turma';</script>";
                        }
                    }
                    ?>
                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="134">
                                    Nome da turma
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nome_turma" id="textfield">
                                </td>
                            </tr>
                            <tr>
                                <td width="134">
                                    Quantidade de alunos
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="qtde_alunos" id="textfield" min="1">
                                </td>
                            </tr>
                            <td>
                                <td>
                                    <input class="input" type="submit" name="cadastra_turma" id="button" value="Cadastrar">
                                </td>
                                </tr>
                        </table>
                    </form>
                    <br/>
                    <?php
                    die;
                }
                ?>

                <!VISUALIZAR AS TURMAS CADASTRADAS>
                <br/> 
                <a class="a2" href="cursos_e_disciplinas.php?pg=turma&amp;cadastra=sim">Cadastrar turma</a>

                <?php
                $select_turma = $crud->select('id_turma, nome_turma, quantidade_alunos, disponivel', 'turma', 'ORDER BY nome_turma')->run();

                if ($select_turma->rowCount() <= 0) {
                    echo "<br><br>No momento não existe nenhuma turma cadastrada!<br><br>";
                } else {
                    ?>
                    <br/>
                    <h1>Turmas</h1>
                    <table width="900" border="0" class="bordasimples">
                        <thead>
                            <tr>
                                <th><center><strong> Turma </strong></center></th>
                                <th><center><strong>Total de alunos nesta turma</strong></center></th>
                                <th><center><strong>Modificar</strong></center></th>
                            </tr>
                        </thead>
                        <?php
                        while ($valores_turma = $select_turma->fetch(PDO::FETCH_ASSOC)) {

                            $class = @$i % 2 == 0 ? ' class="dif"' : '';

                            $nome_turma = $valores_turma['nome_turma'];
                            $qtde_alunos = $valores_turma['quantidade_alunos'];
                            $cod_turma = $valores_turma['id_turma'];
                            $select_count_turma = $crud->select('id_aluno', 'matricula', 'WHERE id_turma = ?')->run([$cod_turma]);
                            ?>
                            <tr <?php echo $class; ?>>
                                <td><center><?php echo $nome_turma; ?></center></td>
                                <td><center><?php echo $select_count_turma->rowCount() . ' | ' . $qtde_alunos; ?></center></td>
                                <td>
                                    <center>
                                        <a href="cursos_e_disciplinas.php?pg=turma&amp;op=visualizar&turma=<?php echo $cod_turma; ?>" ><img title="Visualizar Turma <?php echo $nome_turma; ?>" src="img/lupa_turma.png" width="18" height="18" border="0"/></a>
                                        <a href="cursos_e_disciplinas.php?pg=turma&amp;op=atualizar&turma=<?php echo $cod_turma; ?>"><img title="Atualizar Turma <?php echo $nome_turma; ?>" src="img/editar.png" width="18" height="18" border="0"/></a>
                                        <a href="cursos_e_disciplinas.php?pg=turma&amp;op=deletar&turma=<?php echo $cod_turma; ?>"><img title="Deletar Turma <?php echo $nome_turma; ?>" src="img/deletar.ico" width="18" height="18" border="0"/></a>
                                    </center>
                                </td>
                            </tr>
                            <?php
                            @$i++;
                        }
                        ?>
                    </table>
                    <br/>
            <?php } ?>
            </div>
<?php } ?>
    </body>
</html>