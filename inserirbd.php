<?php
if(isset($_POST['enviar'])){

    $num_campos = num_campos($table,$pdo);

    for($x=0;$x<$num_campos;$x++){
        $campo = nome_campo($sth, $x);

        if($x==0) continue;

		if($x<$num_campos-1){
            $campos .= "$campo,";
            $valores .= ":$campo, ";
		}else{
            $campos .= "$campo";
            $valores .= ":$campo";
		}
	}

    $sql = "INSERT INTO $table ($campos) VALUES ($valores)";
    $sth = $pdo->prepare($sql);    

    for($x=1;$x<$num_campos;$x++){
		$select = $pdo->query("SELECT * FROM $table");
        $campo = nome_campo($select, $x);

		$sth->bindParam(":$campo", $_POST["$campo"], PDO::PARAM_INT);
	}
    $executa = $sth->execute();

    if($executa){
         print "<script>location='$tb';</script>";
    }else{
        echo 'Erro ao inserir os dados';
    }
}

?>

