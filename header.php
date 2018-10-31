<?php
//require './class/config.class.php';
//INSERT
//$crud->insert('turma', 'nome_turma, quantidade_alunos', '(?,?)')
     //->run(['1J', '50']);
          
//SELECT
//$select = $crud->select('COUNT(*) AS "número de registros"', 'produtos', 'WHERE ID > ?')->run(['15']);
//foreach ( $select as $produto) {
//    var_dump($produto);
//}
//echo $produto = ($produto[0] >= 1) ? 'há registros' : 'não há registros';

// UPDATE
//$up = $crud->update('produtos', 'preco = ?', 'WHERE ID = ?')
//           ->run(['7', '15']);
//var_dump($up->rowCount());

// DELETE
//$del = $crud->delete('produtos', 'WHERE ID = ?')
//            ->run(['17']);
//    print $del->rowCount().' row affected';


//var_dump($crud->con()->lastInsertId());
//var_dump($crud->last_id());

header("Content-Type: text/html; charset=utf-8", true);

$num_values = 10;

$db = new pdo( 'sqlite::memory:' );

$db->exec( 'CREATE TABLE data (binary BLOB(512));' );

// generate plenty of troublesome, binary data
for( $i = 0; $i < $num_values; $i++ )
{
    for( $val = null, $c = 0; $c < 256/128; $c++ )
        $val .= md5( mt_rand(), true );
    @$binary[] = $val;
}

// insert each value by prepared statement
for( $i = 0; $i < $num_values; $i++ ){
    $ok = $db->prepare( 'INSERT INTO data VALUES (?);' );
    $ok->execute( array($binary[$i]) );
}
var_dump($binary);

// fetch the entire row
$data = $db->query( 'SELECT binary FROM data;' )->fetchAll( PDO::FETCH_COLUMN );

var_dump($data);

// compare with original array, noting any mismatch
for( $i = 0; $i < $num_values; $i++ )
    if( $data[$i] != $binary[$i] ) echo "[$i] mismatch\n";

$db = null;

