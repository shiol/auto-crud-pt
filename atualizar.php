<?php
require_once('./cabecalho.php');
require_once('./conexao.php');

// Receebr o id via POST deste arquivo ou via GET do busca_resultados.php
if(isset($_POST['id'])){
	$id=$_POST['id'];
}else{
	$id=$_GET['id'];
}

// Mostrar nome da Tabela
print '<h3 align="center">'.ucfirst($table).'</h3>';
?>

<!-- Mostrar form de atualização -->
<div class="container" align="center">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="atualizar.php">
                <table class="table table-bordered table-responsive table-hover">

<?php
    $sth = $pdo->prepare("SELECT * from $table WHERE id = :id");
    $sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um único bindValue
    $sth->execute();

    $reg = $sth->fetch(PDO::FETCH_OBJ);

    $num_campos = num_campos($table,$pdo);
            
    for($x=0;$x<$num_campos;$x++){
        $campo = nome_campo($sth, $x);
?>
        <tr><td><b><?=ucfirst($campo)?></td><td><input type="text" name="<?=$campo?>" value="<?=$reg->$campo?>"></td></tr>
<?php
}
?>
            <input name="id" type="hidden" value="<?=$id?>">
            <tr><td></td><td><input name="enviar" class="btn btn-primary" type="submit" value="Editar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
            </table>
        </form>
        </div>
    <div>
</div>
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
require_once('./rodape.php');
?>
