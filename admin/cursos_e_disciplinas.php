<?php require "topo.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Adminstração</title>
        <link href="css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />	
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

                <br/><br/>
                <a class="a2" href="cursos_e_disciplinas.php?pg=turma&amp;cadastra=sim">Cadastrar turma</a>

                <! CADASTRANDO NOVAS TURMAS >

                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                    <br/><br/>
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

                <!>

                <!VISUALIZAR AS TURMAS CADASTRADAS>

                <?php
                $select_turma = $crud->select('id_turma, nome_turma, quantidade_alunos, disponivel', 'turma', 'ORDER BY nome_turma')->run();

                if ($select_turma->rowCount() <= 0) {
                    echo "<br><br>No momento não existe nenhuma turma cadastrada!<br><br>";
                } else {
                    ?>
                    <br/><br/>
                    <h1>Turmas</h1>
                    <table width="900" border="0">
                        <tr>
                            <td><center><strong>Turma</strong></center></td>
                            <td><center><strong>Total de alunos nesta turma</strong></center></td>
                            <td><center><strong>Modificar</strong></center></td>
                        </tr>
                        <?php
                        while ($valores_turma = $select_turma->fetch(PDO::FETCH_ASSOC)) {
                            $nome_turma = $valores_turma['nome_turma'];
                            $qtde_alunos = $valores_turma['quantidade_alunos'];
                            $cod_turma = $valores_turma['id_turma'];
                            $select_count_turma = $crud->select('id_aluno', 'matricula', 'WHERE id_turma = ?')->run([$cod_turma]);
                            ?>
                            <tr>
                                <td><center><?php echo $nome_turma; ?></center></td>
                                <td><center><?php echo $select_count_turma->rowCount() . ' | ' . $qtde_alunos; ?></center></td>
                                <td>
                                    <center>
                                        <a href="cursos_e_disciplinas.php?pg=turma&amp;op=visualizar&turma=<?php echo $cod_turma; ?>" ><img title="Visualizar Turma <?php echo $nome_turma; ?>" src="img/lupa_turma.png" width="18" height="18" border="0"></a>
                                        <a href="cursos_e_disciplinas.php?pg=turma&amp;op=atualizar&turma=<?php echo $cod_turma; ?>"><img title="Atualizar Turma <?php echo $nome_turma; ?>" src="img/editar.png" width="18" height="18" border="0"></a>
                                        <a href="cursos_e_disciplinas.php?pg=turma&amp;op=deletar&turma=<?php echo $cod_turma; ?>"><img title="Deletar Turma <?php echo $nome_turma; ?>" src="img/deletar.ico" width="18" height="18" border="0"></a>
                                    </center>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br/><br/>
                <?php } ?>
            </div>
        <?php } ?>

        <!>

        <!CADASTRAR MATRICULAS>

        <?php if (@$_GET['pg'] == 'matricula') { ?>

            <div id="box_curso">
                <a class="a2" href="cursos_e_disciplinas.php?pg=matricula&amp;cadastra=sim">Matricular Alunos</a>

                <!Editando a Matricula>

                <?php if (@$_GET['op'] == 'atualizar') { ?>

                    <?php
                    $cod_aluno = $_GET['aluno'];
                    $select_update_matricula = "SELECT * FROM matricula WHERE id_aluno = '$cod_aluno'";
                    $sql_select_update_matricula = mysqli_query($conexao, $select_update_matricula)or die(mysqli_error($conexao));
                    $select_update_matricula_valores = mysqli_fetch_assoc($sql_select_update_matricula);
                    $nome_turma = $select_update_turma_valores['nome_turma'];
                    $quantidade_alunos = $select_update_turma_valores['quantidade_alunos'];
                    ?>

                    <?php
                    if (isset($_POST['salvar'])) {

                        $nome_turma_post = $_POST['nome_turma'];
                        $quantidade_alunos_post = $_POST['qtde_alunos'];

                        if (($nome_turma != $nome_turma_post) || ($quantidade_alunos != $quantidade_alunos_post)) {

                            $update_turma = "UPDATE turma SET nome_turma = '$nome_turma_post', quantidade_alunos = '$quantidade_alunos_post' WHERE turma.id_turma = '$cod_turma'";

                            $sql_update_turma = mysqli_query($conexao, $update_turma) or die(mysqli_error($conexao));

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

                <!--DELEÇÃO DAS TURMAS>
                
                <?php /* if(@$_GET['op'] == 'deletar'){

                  $cod_turma = $_GET['turma'];
                  $sql_deleta_turma = "DELETE FROM turma WHERE id_turma = '$cod_turma'";
                  mysqli_query($conexao, $sql_deleta_turma) or die(mysqli_error($conexao));
                  } */ ?>
                <!-->

                <?php if (@$_GET['cadastra'] == 'sim') { ?>
                    <h1>Nova matricula</h1>

                    <?php
                    if (isset($_POST['cadastra'])) {

                        $cod_aluno = $_POST['nome_aluno'];
                        $cod_turma = $_POST['turma'];

                        if ($cod_aluno == '') {
                            echo "<script language='javascript'>window.alert('Digite o nome ou codigo do aluno ');</script>";
                        } else if ($cod_turma == '') {
                            echo "<script language='javascript'>window.alert('Digite o nome da turma');</script>";
                        } else {

                            $sql_consulta_aluno_matriculado = ("SELECT * FROM inscricao i INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao WHERE i.nome_aluno = '$cod_aluno' OR a.id_aluno = '$cod_aluno'");

                            $resultado_consulta_aluno_matriculado = mysqli_query($conexao, $sql_consulta_aluno_matriculado) or die(mysqli_error($conexao));
                            $resultado_consulta_aluno_format = mysqli_fetch_assoc($resultado_consulta_aluno_matriculado);
                            $cod_aluno_format = $resultado_consulta_aluno_format['id_aluno'];

                            if (mysqli_num_rows($resultado_consulta_aluno_matriculado) <= 0) {
                                echo "<script language='javascript'>window.alert('Aluno não Encontrado!');</script>";
                            } else {
                                $data_formato_mysql = date("Y-m-d");
                                $sql_cadastrar_matricula = "INSERT INTO matricula (id_turma, id_aluno, data_matricula) VALUES ('$cod_turma', '$cod_aluno_format','$data_formato_mysql')";
                                $cadastrar_matricula = mysqli_query($conexao, $sql_cadastrar_matricula) or die(mysqli_error($conexao));

                                if ($cadastrar_matricula == '') {
                                    echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
                                } else {
                                    echo "<script language='javascript'>window.alert('Matricula cadastrada com sucesso!');window.location='cursos_e_disciplinas.php?pg=matricula';</script>";
                                    echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=matricula';</script>";
                                }
                            }
                        }
                    }
                    ?>

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td width="134">
                                    Nome completo ou código do aluno:
                                </td>
                                <td width="213">
                                    Turmas:
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nome_aluno" id="textfield" maxlength="120">
                                </td>
                                <td>
                                    <select name="turma">
                                        <?php
                                        $sql_resultado_consulta_turma_3 = "SELECT * FROM turma WHERE nome_turma != ''";

                                        $resultado_consulta_turma_3 = mysqli_query($conexao, $sql_resultado_consulta_turma_3) or die(mysqli_error($conexao));

                                        while ($valores_turma = mysqli_fetch_assoc($resultado_consulta_turma_3)) {
                                            ?>

                                            <option value="<?php echo $valores_turma['id_turma']; ?>">
                                                <?php echo $valores_turma['nome_turma']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td width="126">
                                    <input class="input" type="submit" name="cadastra" id="button" value="Matricular">
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php
                    die;
                }
                ?>

                <!MOSTRAR AS MATRICULAS NA TABELA>

                <br/><br/>

                <h1>
                    <center>Matriculados </center>
                </h1>

                <?php
                $sql_consulta_matriculas = "SELECT * FROM matricula m INNER JOIN aluno a ON a.id_aluno = m.id_aluno INNER JOIN inscricao i ON i.id_inscricao = a.id_inscricao INNER JOIN turma t ON t.id_turma = m.id_turma ORDER BY t.nome_turma ASC";

                $resultado_consulta_matricula = mysqli_query($conexao, $sql_consulta_matriculas) or die(mysqli_error($conexao));

                if (mysqli_num_rows($resultado_consulta_matricula) == '') {
                    echo "<h2>No momento não existe nenhuma matricula!</h2><br><br>";
                } else {
                    ?>
                    <table width="900" border="0">
                        <tr>
                            <td>
                                <strong>Turma:</strong>
                            </td>
                            <td>
                                <strong>Aluno:</strong>
                            </td>
                            <td>
                                <strong>Modificar</strong>
                            </td>
                        </tr>
                        <?php
                        while ($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)) {
                            $nome_turma = $resultado_consulta_matricula_valores['nome_turma'];
                            $nome_aluno = $resultado_consulta_matricula_valores['nome_aluno'];
                            $cod_matricula = $resultado_consulta_matricula_valores['id_matricula'];
                            ?>
                            <tr>
                                <td>
                                    <h3><?php echo $nome_turma; ?></h3>
                                </td>
                                <td>
                                    <h3><?php echo $nome_aluno; ?></h3>
                                </td>
                                <td style="color: #A00C0E">
                                    <a href="cursos_e_disciplinas.php?pg=matricula&amp;op=visualizar&=matricula<?php echo $cod_matricula; ?>" ><img title="Visualizar Matricula de <?php echo $nome_aluno; ?>" src="img/lupa_turma.png" width="18" height="18" border="0"></a>
                                    <a href="cursos_e_disciplinas.php?pg=matricula&amp;op=atualizar&matricula=<?php echo $cod_matricula; ?>"><img title="Atualizar Matricula de <?php echo $nome_aluno; ?>" src="img/editar.png" width="18" height="18" border="0"></a>
                                    <!--<a href="cursos_e_disciplinas.php?pg=matricula&amp;op=deletar&matricula=<?php /* echo $cod_matricula; ?>"><img title="Deletar Matricula de <?php echo $nome_aluno; */ ?>" src="img/deletar.ico" width="18" height="18" border="0"></a>-->
                                </td
                            </tr>
                        <?php } ?>
                    </table>
                <?php } ?>
            </div><!-- box_curso -->
        <?php } ?>

    </body>
</html>