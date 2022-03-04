<?php 

include 'conexao.php';

$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

if(!empty($getMesg)){
    mysqli_query($conn, "INSERT INTO log (mensagem, data) VALUES ('$getMesg', NOW())");
}

$run_query = mysqli_query($conn, "SELECT response FROM bot WHERE LOCATE(query, '$getMesg') > 0") or die("Error");

if(mysqli_num_rows($run_query) > 0){
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['response'];
    echo $replay;
}else{
    echo "Desculpe, não consegui entender o que você precisa.";
}
?>