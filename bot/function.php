<?php 

function select($content, $tabela, $where){
    $result = "SELECT $content FROM $tabela WHERE 1 = 1 $where";
    return $result;
}

?>