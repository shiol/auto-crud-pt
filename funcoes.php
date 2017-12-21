<?php

// Número de campos

function num_campos($table,$pdo){
    $sql = "SELECT * FROM $table";
    $sth = $pdo->query($sql);
    $num_campos = $sth->columnCount();
    return $num_campos;
}

// Nome de campo pelo número $x
function nome_campo($sth, $x){
        $meta = $sth->getColumnMeta($x);
        $campo = $meta['name'];
    return $campo;
}
