<?php

if(isset($_POST['enviar'])){
	$set='';
    $num_campos = num_campos($table,$pdo);
        
    for($x=0;$x<$num_campos;$x++){
        $campo = nome_campo($sth, $x);
	    $$campo = $_POST[$campo];

		if($x<$num_campos-1){
			if($x==0) continue;
			$set .= "$campo=:$campo,";
		}else{
			if($x==0) continue;
			$set .= "$campo=:$campo";
		}
	}

    $sql = "UPDATE $table SET $set WHERE id = :id";
    $sth = $pdo->prepare($sql);

    for($x=0;$x<$num_campos;$x++){
		$sth2 = $pdo->query("SELECT * FROM $table");
        $campo = nome_campo($sth2, $x);
		$sth->bindParam(":$campo", $_POST["$campo"], PDO::PARAM_INT);
	}

   if($sth->execute()){
        print "<script>location='index.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}

?>
