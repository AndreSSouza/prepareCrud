<?php require "topo.php"; ?>﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Estudantes</title>
        <!--<link rel="stylesheet" type="text/css" href="css/estudantes.css"/>-->
        <link rel="stylesheet" type="text/css" href="css/cursos_e_disciplinas.css"/>		
        <script>
            function mostra_nome_aluno(str) {                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("mostra_nome_aluno").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "mostraAluno.php?nome=" + str, true);
                xmlhttp.send();                
            }
        </script>
    </head>

    <body>	

        <!LISTA DE ESPERA>
        <div id="box_curso">

            <?php if (@$_GET['pg'] == 'espera') { ?>

                <!VISUALIZAR ESPERA>

                <?php if (@$_GET['mod'] == 'visualiza') { ?>

                    <?php
                    $cod_inscricao = $_GET['inscricao'];
                    date_default_timezone_set("America/Sao_Paulo");

                    $select_inscricao = $crud->select('id_inscricao, data_inscricao, nome_aluno, sexo_aluno, email, telefone_responsavel, celular_responsavel', 'inscricao', 'WHERE id_inscricao = ?')->run([$cod_inscricao]);

                    $val_select_inscricao = $select_inscricao->fetch(PDO::FETCH_ASSOC);

                    $id_inscricao = $val_select_inscricao['id_inscricao'];
                    $data_inscricao = $val_select_inscricao['data_inscricao'];
                    $nome_inscricao = $val_select_inscricao['nome_aluno'];
                    $sexo_inscricao = $val_select_inscricao['sexo_aluno'];
                    $email_inscricao = $val_select_inscricao['email'];
                    $telefone_inscricao = $val_select_inscricao['telefone_responsavel'];
                    $celular_inscricao = $val_select_inscricao['celular_responsavel'];
                    ?>

                    <br/>									
                    <table>
                        <tr>
                            <td colspan="2"><center><strong><i>Ficha de Inscrição</i></i></strong></center></td>
                        </tr>
                        <tr>
                            <td>Codígo de Inscrição</td>
                            <td>Data de Inscrição</td>							
                        </tr>
                        <tr>
                            <td><input style="width:70px" type="text" name="cod_inscricao" value="<?php echo $cod_inscricao; ?>" disabled/></td>
                            <td><input style="width:145px" type="text" name="data_inscricao" value="<?php echo date('d/m/Y - H:i:m', strtotime($data_inscricao)); ?>" disabled/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><center><strong><i>Dados Pessoais</i></i></strong></center></td>
                        </tr>
                        <tr>
                            <td>Nome</td>
                            <td>Sexo</td>	
                        </tr>
                        <tr>						
                            <td><input style="width:400px" type="text" name="nome_aluno" value="<?php echo $nome_inscricao; ?>" maxlength="120" disabled/></td>
                            <td><input style="width: 145px" type="text" name="sexo_aluno" value="<?php echo $sexo_inscricao; ?>" disabled/></td>							
                        </tr>					
                        <tr>
                            <td colspan="3"><center><strong><i>Contato</i></i></strong></center></td>
                        </tr>
                        <tr>						
                            <td>E-mail</td>
                            <td>Telefone</td>
                            <td>Celular</td>
                        </tr>
                        <tr>						
                            <td><input style="width:400px" type="email" name="email" value="<?php echo $email_inscricao; ?>" disabled></td>
                            <td><input style="width:95px" type="text" name="telefone" maxlength="10" value="<?php echo $telefone_inscricao; ?> " disabled></td>
                            <td><input style="width:105px" type="text" name="celular" maxlength="11" value="<?php echo $celular_inscricao; ?>" disabled></td>
                        </tr>						
                    </table>				
                    <br/>				
                    <?php
                    die;
                }
                ?>		
                <!>

                <!Editando na Lista de Espera>
                <?php if (@$_GET['mod'] == 'edita') { ?>

                    <?php
                    $cod_inscricao = $_GET['inscricao'];

                    $select_inscricao = $crud->select('id_inscricao, data_inscricao, nome_aluno, sexo_aluno, email, telefone_responsavel, celular_responsavel', 'inscricao', 'WHERE id_inscricao = ?')->run([$cod_inscricao]);

                    $val_select_inscricao = $select_inscricao->fetch(PDO::FETCH_ASSOC);

                    $id_inscricao = $val_select_inscricao['id_inscricao'];
                    $data_inscricao = $val_select_inscricao['data_inscricao'];
                    $nome_inscricao = $val_select_inscricao['nome_aluno'];
                    $sexo_inscricao = $val_select_inscricao['sexo_aluno'];
                    $email_inscricao = $val_select_inscricao['email'];
                    $telefone_inscricao = $val_select_inscricao['telefone_responsavel'];
                    $celular_inscricao = $val_select_inscricao['celular_responsavel'];
                    ?>

                    <?php
                    if (isset($_POST['salvar'])) {

                        $nome_post = $_POST['nome_aluno'];
                        $sexo_post = $_POST['sexo'];
                        $email_post = $_POST['email'];
                        $telefone_post = $_POST['telefone'];
                        $celular_post = $_POST['celular'];

                        $update_inscricao = $crud->update('inscricao', 'nome_aluno = :nome, sexo_aluno = :sexo, email = :email, telefone_responsavel = :telefone, celular_responsavel = :celular', 'WHERE id_inscricao = :id_inscricao')->run([':nome' => $nome_post, ':sexo' => $sexo_post, ':email' => $email_post, ':telefone' => $telefone_post, ':celular' => $celular_post, ':id_inscricao' => $id_inscricao]);

                        echo "<script language='javascript'> window.alert('Atualizado com Sucesso'); window.location='estudantes.php?pg=espera';</script>";
                    }
                    ?>
                    <br/>
                    <form method="post">					
                        <table>
                            <tr>
                                <td colspan="2"><center><strong><i>Ficha de Inscrição</i></i></strong></center></td>
                            </tr>
                            <tr>
                                <td>Codígo de Inscrição</td>
                                <td>Data de Inscrição</td>							
                            </tr>
                            <tr>
                                <td><input style="width:70px" type="text" name="cod_inscricao" value="<?php echo $cod_inscricao; ?>" disabled/></td>
                                <td><input style="width:145px" type="text" name="data_inscricao" value="<?php
                                    date_default_timezone_set("America/Sao_Paulo");
                                    echo date('d/m/Y - H:i', strtotime($data_inscricao));
                                    ?>" disabled/></td>							
                            </tr>
                            <tr>
                                <td colspan="2"><center><strong><i>Dados Pessoais</i></i></strong></center></td>
                            </tr>
                            <tr>
                                <td>Nome</td>
                                <td>Sexo</td>	
                            </tr>
                            <tr>						
                                <td><input style="width:400px" type="text" name="nome_aluno" value="<?php echo $nome_inscricao; ?>" maxlength="120"/></td>
                                <td>
                                    <select name="sexo" size="1" id="">
                                        <option value="<?php echo $sexo_inscricao; ?>"><?php
                                            $mostra_sexo = strtolower($sexo_inscricao);
                                            echo ucfirst($mostra_sexo);
                                            ?></option>
                                        <?php if ($sexo_inscricao == "MASCULINO") { ?>
                                            <option value="FEMININO">Feminino</option>
                                            <option value="OUTRO">Outro</option>
                                        <?php } elseif ($sexo_inscricao == "FEMININO") { ?>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="OUTRO">Outro</option>
                                        <?php } else { ?>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="FEMININO">Feminino</option>
                                        <?php } ?>								
                                    </select>
                                </td>
                            </tr>					
                            <tr>
                                <td colspan="3"><center><strong><i>Contato</i></i></strong></center></td>
                            </tr>
                            <tr>						
                                <td>E-mail</td>
                                <td>Telefone</td>
                                <td>Celular</td>
                            </tr>
                            <tr>						
                                <td><input style="width:400px" type="email" name="email" value="<?php echo $email_inscricao; ?>"></td>
                                <td><input style="width:95px" type="text" name="telefone" maxlength="10" value="<?php echo $telefone_inscricao; ?>"></td>
                                <td><input style="width:105px" type="text" name="celular" maxlength="11" value="<?php echo $celular_inscricao; ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><center><input class="input" type="submit" name="salvar" value="Salvar"/> <a class="a2" href="estudantes.php?pg=espera">Cancelar</a></center></td>
                            </tr>
                        </table>
                    </form>
                    <br/>

                    <?php
                    die;
                }
                ?>

                <br/><br/>
                <a class="a2" href="estudantes.php?pg=espera&amp;cadastra=sim">Cadastrar na lista de espera</a>

                <!CADASTRANDO NA LISTA DE ESPERA>

                <?php if (@$_GET['cadastra'] == 'sim') { ?> 

                    <h1>Cadastrar Aluno para Lista de Espera</h1>

                    <?php
                    if (isset($_POST['button'])) {

                        date_default_timezone_set("America/Sao_Paulo");
                        $data_hora_formato_mysql = date("Y-m-d H:i:s");

                        $nome_inscricao = $_POST['nome'];
                        $sexo = $_POST['sexo'];
                        $email = $_POST['email'];
                        $telefone = $_POST['telefone'];
                        $celular = $_POST['celular'];

                        if (empty($nome_inscricao)) {
                            echo "<script language='javascript'>window.alert('Digite o nome do aluno');</script>";
                        } else {
                            $insert_inscricao = $crud->insert('inscricao', 'data_inscricao, nome_aluno, sexo_aluno, email, telefone_responsavel, celular_responsavel', '(:data, :nome, :sexo, :email, :telefone, :celular)')->run([':data' => $data_hora_formato_mysql, ':nome' => $nome_inscricao, ':sexo' => $sexo, ':email' => $email, ':telefone' => $telefone, ':celular' => $celular]);

                            if ($insert_inscricao->rowCount <= 0) {
                                echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                            } else {
                                echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
                                echo "<script language='javascript'>window.location='estudantes.php?pg=espera';</script>";
                            }
                        }
                    }
                    ?> 

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td>Código de inscrição:</td>					
                                <td>Nome:</td>
                                <td>Sexo:</td>
                            </tr>
                            <tr>
                                <?php
                                $select_last_id = $crud->select('id_inscricao', 'inscricao', 'ORDER BY id_inscricao DESC LIMIT 1')->run();

                                if ($select_last_id->rowCount() <= 0) {
                                    $novo_cod_inscricao = 1;
                                    ?>

                                    <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_inscricao; ?>" /></td>
                                    <input type="hidden" name="code" value="<?php echo $novo_cod_inscricao; ?>" />


                                    <?php
                                } else {
                                    while ($val_last_id = $select_last_id->fetch(PDO::FETCH_ASSOC)) {
                                        $novo_cod_inscricao = $val_last_id['id_inscricao'] + 1;
                                        ?>
                                        <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_inscricao; ?>" /></td>
                                        <input type="hidden" name="code" value="<?php echo $novo_cod_inscricao; ?>" />
                                        <?php
                                    }
                                }
                                ?>							
                                <td>
                                    <input type="text" name="nome" id="textfield">
                                </td>
                                <td>
                                    <select name="sexo" size="1" id="textfield">
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    </select>
                                </td>      						
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td>Telefone:</td>
                                <td>Celular:</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" name="email" id="textfield">
                                </td>
                                <td>
                                    <input type="text" name="telefone" id="textfield" maxlength="10">
                                </td>
                                <td>
                                    <input type="text" name="celular" id="textfield" maxlength="11">
                                </td>
                            </tr>    
                            <tr>
                                <td>
                                    <input class="input" type="submit" name="button" id="button" value="Cadastrar">
                                </td>                                
                            </tr>
                        </table>
                    </form>
                    <br/>
                    <?php
                    die;
                }
                ?>
                <!-- fim div estudante Lista Espera -->

                <!CONSULTA DA LISTA DE ESPERA>

                <?php
                $select_inscricao = $crud->select('id_inscricao, data_inscricao, nome_aluno, email, telefone_responsavel, celular_responsavel', 'inscricao', 'WHERE nome_aluno IS NOT NULL ORDER BY data_inscricao ASC')->run();

                if ($select_inscricao->rowCount() == '') {
                    echo "<h2>Não exisite nenhuma inscrição no momento</h2>";
                } else {
                    ?>
                    <br/><br/>
                    <h1>Alunos que estão na lista de espera</h1>
                    <table width="900" border="0">
                        <tr>
                            <td width="100">
                                <center><strong>Código de Inscrição</strong></center>
                            </td>
                            <td width="100">
                                <center><strong>Data de Inscrição</strong></center>
                            </td>							
                            <td>
                                <center><strong>Nome Completo</strong></center>
                            </td>							
                            <td>
                                <center><strong>E-mail</strong></center>
                            </td>
                            <td>
                                <center><strong>Telefone</strong></center>
                            </td>	
                            <td>
                                <center><strong>Celular</strong></center>
                            </td>
                            <td>
                                <center><strong>Modificar</strong></center>
                            </td>
                        </tr>
                        <?php
                        while ($val_select_inscricao = $select_inscricao->fetch(PDO::FETCH_ASSOC)) {

                            $id_inscricao = $val_select_inscricao['id_inscricao'];
                            $data_inscricao = $val_select_inscricao['data_inscricao'];
                            $nome_inscricao = $val_select_inscricao['nome_aluno'];
                            $email_inscricao = $val_select_inscricao['email'];
                            $telefone_inscricao = $val_select_inscricao['telefone_responsavel'];
                            $celular_inscricao = $val_select_inscricao['celular_responsavel'];
                            ?>
                            <tr>
                                <td> 
                                    <center><?php echo $id_inscricao; ?></center>
                                </td>
                                <td>
                                    <center><?php echo date("d/m/Y h:i:s", strtotime($data_inscricao)); ?></center>
                                </td>							
                                <td>
                                    <center><?php echo $nome_inscricao; ?></center>
                                </td>							
                                <td>
                                    <center><?php echo $email_inscricao; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $telefone_inscricao; ?></center>
                                </td>
                                <td>
                                    <center><?php echo $celular_inscricao; ?></center>
                                </td>
                                <td>
                                    <center>
                                        <a href="estudantes.php?pg=espera&amp;mod=visualiza&inscricao=<?php echo $id_inscricao; ?>" ><img title="Visualizar" src="img/lupa_turma.png" width="18" height="18" ></a>
                                        <a href="estudantes.php?pg=espera&amp;mod=edita&inscricao=<?php echo $id_inscricao; ?>"><img title="Atualizar" src="img/editar.png" width="18" height="18" ></a>
                                        <a href="estudantes.php?pg=espera&amp;mod=deleta&inscricao=<?php echo $id_inscricao; ?>"><img title="Deletar" src="img/deletar.ico" width="18" height="18" ></a>
                                    </center>								
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br/> 
                <?php } ?>

                <?php
                if (@$_GET['mod'] == 'deleta') {

                    $cod_inscricao = $_GET['inscricao'];

                    $sql_delelta_inscricao = "DELETE FROM inscricao WHERE id_inscricao = '$cod_inscricao'";
                    mysqli_query($conexao, $sql_delelta_inscricao) or die(mysqli_error($conexao));

                    echo "<script language='javascript'>window.location='estudantes.php?pg=espera';</script>";
                }
                ?>

            <?php } // aqui fecha a lista de espera      ?>

            <!Visualizar Alunos>

            <?php
            if (@$_GET['mod'] == 'visualiza') {

                $cod_aluno = $_GET['aluno'];

                $select_tudo_aluno = $crud->select('a.id_aluno cod_aluno, i.id_inscricao cod_inscricao, i.data_inscricao dt_inscricao, i.nome_aluno nome, a.data_nascimento_aluno data_nascimento, i.sexo_aluno sexo_aluno, a.rg_aluno rg_aluno, a.cpf cpf_aluno, i.email email_aluno, i.telefone_responsavel telefone_responsavel, i.celular_responsavel celular_responsavel, r.email email_responsavel, r.id_responsavel cod_responsavel, r.nome_responsavel nome_responsavel, r.sexo_responsavel sexo_responsavel, r.rg_responsavel rg_responsavel, r.cpf cpf_responsavel, a.logradouro_aluno logradouro_aluno, a.bairro_aluno bairro_aluno, a.cidade_aluno cidade_aluno, a.complemento_aluno complemento_aluno, a.cep_aluno cep_aluno, a.escola escola_aluno, a.escolaridade escolaridade_aluno, a.matriculado matriculado, m.data_matricula dt_matricula, t.nome_turma nome_turma, m.id_turma id_turma', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao'
                                . ' INNER JOIN responsavel r ON a.id_responsavel = r.id_responsavel'
                                . ' INNER JOIN matricula m ON a.id_aluno = m.id_aluno'
                                . ' INNER JOIN turma t ON m.id_turma = t.id_turma'
                                . ' WHERE a.id_aluno = :id_aluno')
                        ->run([':id_aluno' => $cod_aluno]);
                $dados = $select_tudo_aluno->fetch(PDO::FETCH_ASSOC);
                $cod_inscricao = $dados['cod_inscricao'];
                $dt_inscricao = $dados['dt_inscricao'];
                $cod_aluno = $dados['cod_aluno'];
                $nome_A = $dados['nome'];
                $sexo_A = $dados['sexo_aluno'];
                $data_nascimento_A = $dados['data_nascimento'];
                $data_nascimento_A = date('d/m/Y', strtotime($data_nascimento_A));

                list($dia, $mes, $ano) = explode('/', $data_nascimento_A);
                $dt_hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $dt_nascimento_aluno = mktime(0, 0, 0, $mes, $dia, $ano);
                $idade_A = floor((((($dt_hoje - $dt_nascimento_aluno) / 60) / 60) / 24) / 365.25);

                $RG_A = $dados['rg_aluno'];
                $CPF_A = $dados['cpf_aluno'];
                $email_A = $dados['email_aluno'];
                $email_R = $dados['email_responsavel'];
                $telefone_R = $dados['telefone_responsavel'];
                $celular_R = $dados['celular_responsavel'];
                $cod_responsavel = $dados['cod_responsavel'];
                $nome_R = $dados['nome_responsavel'];
                $sexo_R = $dados['sexo_responsavel'];
                $rg_R = $dados['rg_responsavel'];
                $cpf_R = $dados['cpf_responsavel'];
                $logradouro_A = $dados['logradouro_aluno'];
                $bairro_A = $dados['bairro_aluno'];
                $cidade_A = $dados['cidade_aluno'];
                $complemento_A = $dados['complemento_aluno'];
                $cep_A = $dados['cep_aluno'];
                $escola_A = $dados['escola_aluno'];
                $escolaridade_A = $dados['escolaridade_aluno'];
                $matriculado = $dados['matriculado'];
                $dt_matricula = $dados['dt_matricula'];
                $dt_matricula = date("d/m/Y", strtotime($dt_matricula));
                $nome_turma = $dados['nome_turma'];
                $cod_turma = $dados['id_turma'];

                //relacionado a chamada
                $qtde_faltas = $crud->select('COUNT(presenca) AS faltas', 'chamada', 'WHERE id_aluno = :id_aluno AND presenca = 0')->run([':id_aluno' => $cod_aluno]);
                $val_faltas = $qtde_faltas->fetch(PDO::FETCH_ASSOC);
                $faltas = $val_faltas['faltas'];

                //quantidade de aulas já dadas
                $select_qtde_aulas = $crud->select('COUNT(DISTINCT(c.data_chamada)) AS "aulas_dadas"', 'chamada c', 'INNER JOIN matricula m ON m.id_aluno = c.id_aluno WHERE (c.data_chamada BETWEEN m.data_matricula AND CURRENT_DATE) AND c.id_aluno = :id_aluno')->run([':id_aluno' => $cod_aluno]);
                $val_aulas_dadas = $select_qtde_aulas->fetch(PDO::FETCH_ASSOC);
                $qtde_aulas = $val_aulas_dadas['aulas_dadas'];

                $chamada = $crud->select('c.data_chamada data_chamada, t.nome_turma nome_turma, p.nome_professor nome_professor, i.nome_aluno nome_aluno, c.presenca presenca', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao INNER JOIN responsavel r ON a.id_responsavel = r.id_responsavel INNER JOIN matricula m ON a.id_aluno = m.id_aluno INNER JOIN turma t ON m.id_turma = t.id_turma INNER JOIN chamada c ON c.id_aluno = a.id_aluno INNER JOIN professor p ON p.id_professor = c.id_professor WHERE (c.data_chamada BETWEEN m.data_matricula AND CURRENT_DATE) AND a.id_aluno = :id_aluno AND m.id_turma = :id_turma ORDER BY c.data_chamada')->run([':id_aluno' => $cod_aluno, ':id_turma' => $cod_turma]);
                ?>

                <table border="0">
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Informações Pessoais do Aluno</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Código de Inscrição:</td>
                        <td>Data de Inscrição:</td>
                        <td>Código do Aluno:</td>								
                    </tr>
                    <tr>
                        <td>							
                            <input type="text" value="<?php echo $cod_inscricao; ?>" disabled >
                        </td>
                        <td>													
                            <input type="text" value="<?php echo $dt_inscricao = date('d/m/Y', strtotime($dt_inscricao)); ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $cod_aluno; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>Sexo:</td>
                        <td>Data de Nascimento:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $nome_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $sexo_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $data_nascimento_A; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Idade:</td>
                        <td>RG:</td>
                        <td>CPF:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $idade_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $RG_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $CPF_A; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Informações Pessoais do Responsável</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Código do Responsavel:</td>
                        <td>Nome:</td>
                        <td>Data de Nascimento:</td>
                        <td>Sexo:</td>
                    </tr>
                    <tr>
                        <td>							
                            <input style="width: 25px" type="text" value="<?php echo $cod_responsavel; ?>" disabled >
                        </td>
                        <td>													
                            <input type="text" value="<?php echo $nome_R; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="Falta Inplementar o campo data de nascimento na tabela professor" disabled>
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $sexo_R; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Idade:</td>
                        <td>RG:</td>
                        <td>CPF:</td>								
                    </tr>
                    <tr>
                        <td>							
                            <input type="text" value="falta implementar o campo data de nascimento na tabela professor" disabled >
                        </td>
                        <td>													
                            <input type="text" value="<?php echo $rg_R; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $cpf_R; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <br>
                            <i><center><b>Contatos</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail do Aluno:</td>
                        <td>E-mail do Responsavel:</td>
                        <td>Telefone do Responsavel:</td>
                        <td>Celular do Responsavel:</td>								
                    </tr>
                    <tr>
                        <td>							
                            <input type="text" value="<?php echo $email_A; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $email_R; ?>" disabled >
                        </td>
                        <td>													
                            <input style="width: 110px" type="text" value="<?php echo $telefone_R; ?>" disabled >
                        </td>
                        <td>							
                            <input style="width: 120px" type="text" value="<?php echo $celular_R; ?>" disabled>
                        </td>
                    </tr>	
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Endereço</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Rua:</td>
                        <td>Número:</td>
                        <td>Bairro:</td>
                    </tr>
                    <tr>
                        <td>							
                            <input type="text" value="<?php echo $logradouro_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $logradouro_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $bairro_A; ?>" disabled >
                        </td>							
                    </tr>
                    <tr>
                        <td>Cidade:</td>	
                        <td>Complemento:</td>
                        <td>CEP:</td>
                    </tr>
                    <tr>								
                        <td>							
                            <input type="text" value="<?php echo $cidade_A; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $complemento_A; ?>" disabled >
                        </td>
                        <td>													
                            <input type="text" value="<?php echo $cep_A; ?>" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Informações adicionais</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Escolaridade:</td>								
                        <td>Escola:</td>									
                        <td>Matriculado:</td>
                    </tr>
                    <tr>								
                        <td>							
                            <input type="text" value="<?php echo $escolaridade_A; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $escola_A; ?>" disabled >
                        </td>
                        <td>													
                            <input type="text" value="<?php echo $matriculado = $matriculado ? "Sim" : "Não"; ?>" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <i><center><b>Matrícula</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Data de matricula:</td>					
                        <td>Turma:</td>								
                    </tr>
                    <tr>								
                        <td>							
                            <input type="text" value="<?php echo $dt_matricula; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $nome_turma; ?>" disabled >
                        </td>							
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <i><center><b>Chamada</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantidade de faltas:</td>					
                        <td>Quantidade de aulas dadas:</td>								
                    </tr>
                    <tr>								
                        <td>							
                            <input type="text" value="<?php echo $faltas; ?>" disabled >
                        </td>
                        <td>							
                            <input type="text" value="<?php echo $qtde_aulas; ?>" disabled>
                        </td>							
                    </tr>
                    <tr>
                        <td colspan="5">
                            <br>
                            <i><center><b>Histórico de presenças</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Data da chamada</b></td>
                        <td><b>Nome da turma</b></td>
                        <td><b>Nome do professor</b></td>
                        <td><b>Nome do aluno</b></td>
                        <td><b>Status</b></td>								
                    </tr>							
                    <?php
                    while ($val_chamada = $chamada->fetch(PDO::FETCH_ASSOC)) {
                        $data_chamada = $val_chamada['data_chamada'];
                        $data_chamada = date("d/m/Y", strtotime($data_chamada));
                        $nomeTurma = $val_chamada['nome_turma'];
                        $nomeProfessor = $val_chamada['nome_professor'];
                        $nomeAluno = $val_chamada['nome_aluno'];
                        $status = $val_chamada['presenca'];
                        $cor = $status ? 'lightgreen' : 'tomato';
                        $status = $status ? "Presença" : "Falta";
                        ?>
                                                                                                                                                                                    <tr style="background-color: <?php echo $cor; ?>">
                            <td><?php echo $data_chamada; ?></td>
                            <td><?php echo $nomeTurma; ?></td>
                            <td><?php echo $nomeProfessor; ?></td>
                            <td><?php echo $nomeAluno; ?></td>
                            <td><?php echo $status; ?></td>
                        </tr>
                    <?php                         
                    } 
                    ?>
            </table>
            <?php die; } ?>
            <!>
                                                                                                                                                            
            <!Editar Alunos>
            
            <?php 
            if (@$_GET['mod'] == 'atualiza') {

                $cod_aluno = $_GET['aluno'];
                    
                $select_tudo_aluno = $crud->select('a.id_aluno cod_aluno, i.id_inscricao cod_inscricao, i.data_inscricao dt_inscricao, i.nome_aluno nome, a.data_nascimento_aluno data_nascimento, i.sexo_aluno sexo_aluno, a.rg_aluno rg_aluno, a.cpf cpf_aluno, i.email email_aluno, i.telefone_responsavel telefone_responsavel, i.celular_responsavel celular_responsavel, r.email email_responsavel, r.id_responsavel cod_responsavel, r.nome_responsavel nome_responsavel, r.sexo_responsavel sexo_responsavel, r.rg_responsavel rg_responsavel, r.cpf cpf_responsavel, a.logradouro_aluno logradouro_aluno, a.bairro_aluno bairro_aluno, a.cidade_aluno cidade_aluno, a.complemento_aluno complemento_aluno, a.cep_aluno cep_aluno, a.escola escola_aluno, a.escolaridade escolaridade_aluno, a.matriculado matriculado, m.data_matricula dt_matricula, t.nome_turma nome_turma, m.id_turma id_turma', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao'
                                . ' INNER JOIN responsavel r ON a.id_responsavel = r.id_responsavel'
                                . ' INNER JOIN matricula m ON a.id_aluno = m.id_aluno'
                                . ' INNER JOIN turma t ON m.id_turma = t.id_turma'
                                . ' WHERE a.id_aluno = :id_aluno')
                        ->run([':id_aluno' => $cod_aluno]);
                $dados = $select_tudo_aluno->fetch(PDO::FETCH_ASSOC);

                $cod_aluno = $dados['cod_aluno'];
                $nome_A = $dados['nome'];
                $sexo_A = $dados['sexo_aluno'];
                $data_nascimento_A = $dados['data_nascimento'];
                $RG_A = $dados['rg_aluno'];
                $CPF_A = $dados['cpf_aluno'];
                $email_A = $dados['email_aluno'];
                $email_R = $dados['email_responsavel'];
                $telefone_R = $dados['telefone_responsavel'];
                $celular_R = $dados['celular_responsavel'];
                $cod_responsavel = $dados['cod_responsavel'];
                $nome_R = $dados['nome_responsavel'];
                $sexo_R = $dados['sexo_responsavel'];
                $rg_R = $dados['rg_responsavel'];
                $cpf_R = $dados['cpf_responsavel'];
                $logradouro_A = $dados['logradouro_aluno'];
                $bairro_A = $dados['bairro_aluno'];
                $cidade_A = $dados['cidade_aluno'];
                $complemento_A = $dados['complemento_aluno'];
                $cep_A = $dados['cep_aluno'];
                $escola_A = $dados['escola_aluno'];
                $escolaridade_A = $dados['escolaridade_aluno'];
                ?>
                <br><br>

                <form method="post">
                    <table border="0">
                        <tr>
                            <td colspan="3">
                                <br>
                                <i><center><b>Informações pessoais do aluno</b></center></i>
                                <br>
                            </td>
                        </tr>							
                        <tr>
                            <td>Nome:</td>
                            <td>Sexo:</td>
                            <td>Data de nascimento:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nomeA" value="<?php echo $nome_A; ?>" >
                            </td>
                            <td>
                                <select name="sexoA" size="1" id="">
                                    <option value="<?php echo $sexo_A; ?>">
                                        <?php 
                                        $mostra_sexo = strtolower($sexo_A);
                                        echo ucfirst($mostra_sexo); 
                                        ?>
                                    </option>
                                    <?php if ($sexo_A == "MASCULINO") { ?>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } elseif ($sexo_A == "FEMININO") { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } else { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                    <?php } ?>								
                                </select>									
                            </td>
                            <td>
                                <input type="date" name="dtNascimentoA" value="<?php echo $data_nascimento_A; ?>" >
                            </td>
                        </tr>
                        <tr>								
                            <td>RG:</td>
                            <td>CPF:</td>
                            <td>E-mail do Aluno:</td>
                        </tr>
                        <tr>								
                            <td>
                                <input type="number" name="rgA" value="<?php echo $RG_A; ?>" >
                            </td>
                            <td>
                                <input type="number" name="cpfA" value="<?php echo $CPF_A; ?>" >
                            </td>
                            <td>							
                                <input type="email" name="emailA" value="<?php echo $email_A; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <br>
                                <i><center><b>Informações pessoais do responsável</b></center></i>
                                <br>
                            </td>
                        </tr>
                        <tr>								
                            <td>Nome:</td>
                            <td>Data de nascimento:</td>
                            <td>Sexo:</td>
                        </tr>
                        <tr>							
                            <td>													
                                <input type="text" name="nomeR" value="<?php echo $nome_R; ?>"  >
                            </td> 
                            <td>
                                <input type="text" value="Falta Inplementar o campo data de nascimento na tabela responsavel" disabled>
                            </td>
                            <td>
                                <select name="sexoR" size="1" id="">
                                    <option value="<?php echo $sexo_R; ?>">
                                        <?php
                                        $mostra_sexo = strtolower($sexo_R);
                                        echo ucfirst($mostra_sexo);
                                        ?>
                                    </option>
                                    <?php if ($sexo_R == "MASCULINO") { ?>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } elseif ($sexo_R == "FEMININO") { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } else { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>RG:</td>
                            <td>CPF:</td>
                        </tr>
                        <tr>
                            <td>													
                                <input type="number" name="rgR" value="<?php echo $rg_R; ?>" />	
                            </td>
                            <td>
                                <input type="number" name="cpfR" value="<?php echo $cpf_R; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <i><center><b>Contatos</b></center></i>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail do responsavel:</td>
                            <td>Telefone do responsavel:</td>
                            <td>Celular do responsavel:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="emailR" value="<?php echo $email_R; ?>" >
                            </td>
                            <td>
                                <input type="number" name="telefoneR" value="<?php echo $telefone_R; ?>" />
                            </td>
                            <td>
                                <input type="number" name="celularR" value="<?php echo $celular_R; ?>"/> 
                            </td>
                        </tr>	
                        <tr>
                            <td colspan="3">
                                <br>
                                <i><center><b>Endereço</b></center></i>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>Rua:</td>
                            <td>Número:</td>
                            <td>Bairro:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="ruaA" value="<?php echo $logradouro_A; ?>" />
                            </td>
                            <td>
                                <input type="" name="numeroA" value="<?php echo $logradouro_A; ?>" />
                            </td>
                            <td>		
                                <input type="text" name="bairroA" value="<?php echo $bairro_A; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Cidade:</td>
                            <td>Complemento:</td>
                            <td>CEP:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="cidadeA" value="<?php echo $cidade_A; ?>" >
                            </td>
                            <td>
                                <input type="text" name="complementoA" value="<?php echo $complemento_A; ?>" >
                            </td>
                            <td>
                                <input type="number" name="cepA" value="<?php echo $cep_A; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <center>
                                    <br>
                                    <input class="input" type="submit" name="salvar" value="Salvar"/>
                                    <input class="input" type="submit" name="cancelar" value="Cancelar"/>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
                <br/><br/>
                <?php
                if (isset($_POST['cancelar'])) {
                    echo "<script language='javascript'>window.location='estudantes.php?pg=aluno';</script>";
                }
                if (isset($_POST['salvar'])) {

                    $nomeA = $_POST['nomeA'];
                    $sexoA = $_POST['sexoA'];
                    $dtNascimentoA = $_POST['dtNascimentoA'];
                    $rgA = $_POST['rgA'];
                    $cpfA = $_POST['cpfA'];
                    $emailA = $_POST['emailA'];
                    $nomeR = $_POST['nomeR'];
                    $sexoR = $_POST['sexoR'];
                    $emailR = $_POST['emailR'];
                    $rgR = $_POST['rgR'];
                    $cpfR = $_POST['cpfR'];
                    $telefoneR = $_POST['telefoneR'];
                    $celularR = $_POST['celularR'];
                    //$ruaA = $_POST['ruaA'];
                    $numeroA = $_POST['numeroA'];
                    $bairroA = $_POST['bairroA'];
                    $cidadeA = $_POST['cidadeA'];
                    $complementoA = $_POST['complementoA'];
                    $cepA = $_POST['cepA'];

                    if (($nomeA != $nome_A) || ($sexoA != $sexo_A) || ($dtNascimentoA != $data_nascimento_A) || ($rgA != $RG_A) || ($cpfA != $CPF_A) || ($emailA != $email_A) || ($nomeR != $nome_R) || ($sexoR != $sexo_R) || ($emailR != $email_R) || ($telefoneR != $telefone_R) || ($celularR != $celular_R) || ($numeroA != $logradouro_A) || ($bairroA = $bairro_A) || ($cidadeA != $cidade_A) || ($complementoA != $complemento_A) || ($cepA != $cep_A)) {

                        $update_inscricao = $crud->update('inscricao i', 'i.nome_aluno = :nomeA, i.sexo_aluno = :sexoA, i.email = :emailA, i.telefone_responsavel = :telefoneR, i.celular_responsavel = :celularR', 'WHERE i.id_aluno = :id_aluno')->run([':id_aluno' => $cod_aluno, 'nomeA' => $nomeA, ':emailA' => $emailA, ':telefoneR' => $telefoneR, ':celularR' => $celularR]);

                        $update_aluno = $crud->select('aluno a', 'a.data_nascimento_aluno = :dtNascimentoA, a.rg_aluno = :rgA, a.cpf = :cpfA, a.logradouro_aluno = :numeroA, a.bairro_aluno = :bairroA, a.cidade_aluno = :cidadeA, a.complemento_aluno = :complementoA, a.cep_aluno = :cepA', 'WHERE a.id_aluno = :id_aluno')->run([':id_aluno' => $cod_aluno, ':dtNascimentoA' => $dtNascimentoA, ':rgA' => $rgA, ':cpfA' => $cpfA, ':numeroA' => $numeroA, ':bairroA' => $bairroA, ':bairroA' => $bairroA, 'cidadeA' => $cidadeA, ':complementoA' => $complementoA, ':cepA' => $cepA]);

                        $update_responsavel = $crud->update('responsavel r', 'r.nome_responsavel = :nomeR, r.sexo_responsavel = :sexoR, r.email = :emailR, r.rg_responsavel = :rgR, r.cpf = :cpfR', 'WHERE r.id_responsavel = :id_responsavel')->run([':id_responsavel' => $cod_responsavel, ':nomeR' => $nomeR, ':sexoR' => $sexoR, ':emailR' => $emailR, ':rgR' => $rgR, ':cpfR' => $cpfR]);

                        echo "<script language='javascript'> window.alert('Aluno(a) atualizado(a) com Sucesso!'); window.location='estudantes.php?pg=aluno';</script>";
                    }
                } die; 
            } ?>
        <!>
        <!CADASTRO DOS ESTUDANTES>

            <?php if (@$_GET['pg'] == 'cadastra') { ?>
                <?php if (@$_GET['etapa'] == '1') { // aqui abre a etapa 1 ?>			
                    <h1>1ª Etapa: Cadastre os dados pessoais</h1>

                    <?php if (isset($_POST['button'])) {

                        $_aluno = $_POST['code'];
                        $id_inscricao = $_POST['cod_inscricao'];
                        $data_nascimento_aluno = $_POST['data_nascimento_aluno'];
                        $rg_aluno = $_POST['rg_aluno'];
                        $cpf_aluno = $_POST['cpf_aluno'];
                        $logradouro = $_POST['logradouro_aluno'];
                        $bairro_aluno = $_POST['bairro_aluno'];
                        $cidade_aluno = $_POST['cidade_aluno'];
                        $complemento_aluno = $_POST['complemento_aluno'];
                        $cep_aluno = $_POST['cep_aluno'];
                        $escolaridade = $_POST['escolaridade'];
                        $escola = $_POST['escola'];

                        $insert_aluno = $crud->insert('aluno', 'id_inscricao, data_nascimento_aluno, rg_aluno, cpf, logradouro_aluno, bairro_aluno, cidade_aluno, complemento_aluno, cep_aluno, escolaridade, escola', '(:id_inscricao, :data_nascimento_aluno, :rg_aluno, :cpf_aluno, :logradouro_aluno, :bairro_aluno, :cidade_aluno, :complemento_aluno, :cep_aluno, :escolaridade, :escola)')->run([':id_inscricao' => $id_inscricao, ':data_nascimento_aluno' => $data_nascimento_aluno, ':rg_aluno' => $rg_aluno, ':cpf_aluno' => $cpf_aluno, ':logradouro_aluno' => $logradouro, ':bairro_aluno' => $bairro_aluno, ':cidade_aluno' => $cidade_aluno, ':complemento_aluno' => $complemento_aluno, ':cep_aluno' => $cep_aluno, ':escolaridade' => $escolaridade, ':escola' => $escola]);

                        if ($insert_aluno->rowCount() <= 0) {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                        } else {
                            echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=2&inscricao=$id_inscricao';</script>"; 
                        }
                    } ?>

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td></td>
                                <td colspan="2"><strong>Foi criado um código único para este aluno</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>

                                <?php 
                                $select_last_id = $crud->select('id_aluno', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao ORDER BY a.id_aluno DESC LIMIT 1')->run();
                                if ($select_last_id->rowCount() <= 0) {

                                    $novo_id = 1; ?>
                                    <td><input type="text" name="code" disabled="disabled" value="<?php echo $novo_id; ?>" /></td>
                                    <input type="hidden" name="code" value="<?php echo $novo_id; ?>"/>

                                <?php } else {

                                    while ($val_last_id = $select_last_id->fetch(PDO::FETCH_ASSOC)) {

                                        $novo_id = $val_last_id['id_aluno'] + 1; ?>

                                        <td><input type="text" name="code"  disabled="disabled" value="<?php echo $novo_id; ?>" /></td>
                                        <input type="hidden" name="code" value="<?php echo $novo_id; ?>" />
                                    <?php }
                                } ?>

                                <td></td>							
                            </tr>    
                            <tr>
                                <td>Código de inscrição:</td>
                                <td>Nome completo:</td>
                                <td>Data de nascimento:</td>
                            </tr>
                            <tr>
                                <td><input type="number" name="cod_inscricao" onkeyup="mostra_nome_aluno(this.value)" /></td>
                                <td>							
                                    <div id = "mostra_nome_aluno">
                                        <input type="text" disabled="disabled"/>
                                    </div>										
                                </td>
                                <td><input type="date" name="data_nascimento_aluno" /></td>
                            </tr>
                            <tr>
                                <td>RG:</td>
                                <td>CPF:</td>
                                <td>Logradouro:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="rg_aluno" maxlength="14"/></td>
                                <td><input type="text" name="cpf_aluno" maxlength="11"/></td>
                                <td><input type="text" name="logradouro_aluno"/></td>
                            </tr>
                            <tr>														  	
                                <td>Bairro:</td>
                                <td>Cidade:</td>
                                <td>Complemento:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="bairro_aluno" /></td>
                                <td><input type="text" name="cidade_aluno" /></td>
                                <td><input type="text" name="complemento_aluno" /></td>
                            </tr>
                            <tr>      								
                                <td>Cep:</td>
                                <td>Escolaridade:</td>
                                <td>Escola:</td> 
                            </tr>
                            <tr>								
                                <td><input type="text" name="cep_aluno" maxlength="8" /></td>
                                <td>
                                    <select name="escolaridade" size="1" >
                                        <option value="Ensino fundamental cursando">Ensino fundamental cursando</option>
                                        <option value="Ensino fundamental concluído">Ensino fundamental concluído</option>
                                        <option value="Ensino médio cursando">Ensino médio cursando</option>
                                        <option value="Ensino médio concluído">Ensino médio concluído</option>
                                    </select>									
                                </td>
                                <td><input type="text" name="escola" /></td>
                            </tr>							
                            <tr>
                                <td colspan="3"><center><input class="input" type="submit" name="button" value="Avançar"/></center></td>
                            </tr>
                        </table>
                    </form>
                    <br/> 				
                <?php } // aqui fecha a etapa 1 ?>
                <?php if (@$_GET['etapa'] == '2') { // aqui abre a etapa 2 ?>			
                    <h1>2ª Etapa: Cadastro de dados do responsável</h1>
                    <?php if (isset($_POST['button'])) {

                        $id_inscricao = $_GET['inscricao'];
                        $id_responsavel = $_POST['id_responsavel'];
                        $nome_responsavel = $_POST['nome_responsavel'];
                        $sexo_responsavel = $_POST['sexo_responsavel'];
                        $cpf_responsavel = $_POST['cpf_responsavel'];
                        $rg_responsavel = $_POST['rg_responsavel'];
                        $email_responsavel = $_POST['email_responsavel'];

                        $insert_responsavel = $crud->insert('responsavel', 'nome_responsavel, sexo_responsavel, cpf, rg_responsavel, email', '(:nome, :sexo, :cpf, :rg, :email)')->run([':nome' => $nome_responsavel, ':sexo' => $sexo_responsavel, ':cpf' => $cpf_responsavel, ':rg' => $rg_responsavel, ':email' => $email_responsavel]);;
                        if ($insert_responsavel->rowCount() <= 0) {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                        } else {
                            $last_id_respondavel = $crud->con()->lastInsertId();

                            //$sql_select_ultimo_id_responsavel = "SELECT * FROM responsavel r ORDER BY r.id_responsavel DESC LIMIT 1";

                            //$conexao_select_ultimo_id_responsavel = mysqli_query($conexao, $sql_select_ultimo_id_responsavel) or die(mysqli_error($conexao));

                            //while ($resultado_ultimo_id_responsavel_valores = mysqli_fetch_assoc($conexao_select_ultimo_id_responsavel)) {
                                //$id_responsavel_colhido = $resultado_ultimo_id_responsavel_valores['id_responsavel'];
                            //}

                            $crud->update('aluno', 'id_responsavel = :id_responsavel', 'WHERE id_inscricao = :id_inscricao')->run([':id_responsavel' => $last_id_respondavel, ':id_inscricao' => $id_inscricao]);

            //$sql_update_aluno = ("UPDATE aluno SET id_responsavel = '$id_responsavel_colhido' WHERE id_inscricao = '$id_inscricao'");

            //$update_aluno = mysqli_query($conexao, $sql_update_aluno) or die(mysqli_error($conexao));

                            echo "  <script language='javascript'> 
                                        window.alert('Cadastro Realizado com sucesso!!'); 
                                        window.location='estudantes.php?pg=cadastra&etapa=resumo';
                                    </script>";
                        }
                    } ?>

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td><b>Código do responsável:</b></td>			
                                <td>Nome do responsável:</td>
                                <td>Sexo do responsável:</td>
                            </tr>
                            <tr>
                                <?php 
                                $select_novo_id_responsavel = $crud->select('id_responsavel', 'responsavel', 'ORDER BY id_responsavel DESC LIMIT 1')->run();
                                //$sql_select_ultimo_id_responsavel = "SELECT * FROM responsavel r ORDER BY r.id_responsavel DESC LIMIT 1";

                                //$conexao_select_ultimo_id_responsavel = mysqli_query($conexao, $sql_select_ultimo_id_responsavel) or die(mysqli_error($conexao));

                                if ($select_novo_id_responsavel->rowCount() <= 0) {
                                    $novo_id = 1; ?>

                                    <td><input type="text" name="id_responsavel" disabled="disabled" value="<?php echo $novo_id; ?>"/></td>
                                    <input type="hidden" name="id_responsavel" value="<?php echo $novo_id; ?>"/> 
                                <?php } else {
                                    while ($val_novo_id_resp = $select_novo_id_responsavel->fetch(PDO::FETCH_ASSOC)) {
                                        $novo_id = $val_novo_id_resp['id_responsavel'] + 1; ?>
                                        <td><input type="text" name="id_responsavel" disabled="disabled" value="<?php echo $novo_id; ?>"/></td>
                                        <input type="hidden" name="id_responsavel" value="<?php echo $novo_id; ?>" />
                                    <?php }
                                } ?>
                                <td><input type="text" name="nome_responsavel" /></td>
                                <td>
                                    <select name="sexo_responsavel" size="1" >
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    </select>
                                </td>      						
                            </tr>
                            <tr>
                                <td>CPF do responsável:</td>
                                <td>RG do responsável:</td>
                                <td>E-mail do responsável:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="cpf_responsavel" maxlength="11"/></td>
                                <td><input type="text" name="rg_responsavel" maxlength="14"/></td>
                                <td><input type="email" name="email_responsavel" /></td>
                            </tr>    
                            <tr>
                                <td colspan="3"><input class="input" type="submit" name="button" id="button" value="Concluir"/></td>				</tr>
                        </table>
                    </form>
                    <br/>			
                <?php }// aqui fecha o bloco 2 ?>
                <?php if (@$_GET['etapa'] == 'resumo') { // aqui abre a etapa resumo ?>
                    <h1>3º Passo - Mensagem de confirmação</h1>
                    <table>
                        <tr>
                            <td>
                                <h4>Este(a) Estudante cadastrado com sucesso!
                                <ul>
                                    <li>Fique atento em relação a chamada pois com 3 faltas não justificadas ele será removido do cursinho!</li>
                                </ul>
                                <a href="estudantes.php?pg=aluno">Clique aqui para voltar para página de consultas</a>
                                </h4>
                            </td>
                        </tr>
                    </table>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <?php }// aqui fecha a etapa resumo ?>
            <?php }// aqui fecha a PG cadastra ?>

            <!BUSCANDO ESTUDANTES NO BANCO>

            <?php if (@$_GET['pg'] == 'aluno') { ?>
                <a class="a2" href="estudantes.php?pg=cadastra&etapa=1">Cadastrar alunos</a>
                <h1>Alunos cadastradados</h1>
                <?php 
                $select_inscricao_aluno = $crud->select('*', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao WHERE i.nome_aluno IS NOT NULL ORDER BY i.nome_aluno')->run();
                //$sql_consulta_alunos = "SELECT * FROM inscricao i INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao WHERE i.nome_aluno != '' ORDER BY i.nome_aluno";
                //$consulta_alunos = mysqli_query($conexao, $sql_consulta_alunos) or die(mysqli_error($conexao));

                if ($select_inscricao_aluno->rowCount() <= 0) {
                    echo "<h2>Não exisite nenhum aluno cadastrado no momento</h2>";
                } else { ?>
                    <table width="900" border="0">
                        <tr>						
                            <td><center><strong>Código</strong></center></td>
                            <td><center><strong>Nome Completo</strong></center></td>
                            <td><center><strong>RG</strong></center></td>
                            <td><center><strong>CPF</strong></center></td>
                            <td><center><strong>Telefone </strong></center></td>
                            <td><center><strong>Celular</strong></center></td>
                            <td><center><strong>Modificar</strong></center></td>
                        </tr>
                        <?php while ($val_incricao_aluno = $select_inscricao_aluno->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><center><h3><?php echo $val_incricao_aluno['id_aluno']; ?></h3></center></td>
                                <td><center><h3><?php echo $val_incricao_aluno['nome_aluno']; ?></h3></center></td>
                                <td><center><h3><?php echo $val_incricao_aluno['rg_aluno']; ?></h3></center></td>
                                <td><center><h3><?php echo $val_incricao_aluno['cpf']; ?></h3></center></td>
                                <td><center><h3><?php echo $val_incricao_aluno['telefone_responsavel']; ?></h3></center></td>
                                <td><center><h3><?php echo $val_incricao_aluno['celular_responsavel']; ?></h3></center></td>
                                <td>
                                    <center>									
                                        <a href="estudantes.php?pg=aluno&mod=visualiza&aluno=<?php echo $val_incricao_aluno['id_aluno']; ?>" ><img title="Visualizar" src="img/lupa_turma.png" width="18" height="18" border="0"></a>
                                        <a href="estudantes.php?pg=aluno&mod=atualiza&aluno=<?php echo $val_incricao_aluno['id_aluno']; ?>"><img title="Atualizar" src="img/editar.png" width="18" height="18" border="0"></a>
                                        <a href="estudantes.php?pg=aluno&mod=deleta&aluno=<?php echo $val_incricao_aluno['id_aluno']; ?>"><img title="Deletar" src="img/deletar.ico" width="18" height="18" border="0"></a>
                                    </center>	
                                </td>							
                            </tr>
                        <?php } ?>
                    </table>
                    <br/> 
                <?php } ?>		
            <?php } ?>
            <?php if (@$_GET['mod'] == 'deleta'){
                
            }?>
        </div>
    </body>
</html>