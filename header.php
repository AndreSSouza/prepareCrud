<?php

//INSERT
//$crud->insert('produtos', 'descricao, quantidade, preco', '(:desc, :qtde, :pre)')
//     ->run([':desc' => 'Alface', ':qtde' => '120', ':pre' => '2']);
          
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
