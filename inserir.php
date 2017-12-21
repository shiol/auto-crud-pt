<?php
require_once('./cabecalho.php');
require_once('./conexao.php');

// Mostrar o nome da tabela
print '<h3 align="center">'.ucfirst($table).'</h3>';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <table class="table table-bordered table-responsive">    
            <form method="post" action="inserir.php?table=<?=$table?>"> 

<?php
    $sql = "SELECT * FROM $table";
    $sth = $pdo->query($sql);
    $num_campos = num_campos($table,$pdo);

    $tb = "index.php?table=$table";// Variável a ser usada no location
        
    for($x=0;$x<$num_campos;$x++){
        $campo = nome_campo($sth, $x);

        if($x>0){
?>
        <tr><td><b><?=ucfirst($campo)?></td><td><input type="text" name="<?=$campo?>"></td></tr>

<?php
        }
    }
?>
            <input name="table" type="hidden" value="<?=$table?>">
            <tr><td></td><td><input class="btn btn-primary" name="enviar" type="submit" value="Cadastrar">&nbsp;&nbsp;&nbsp;
            <input class="btn btn-warning" name="enviar" type="button" onclick="location='<?=$tb?>'" value="Voltar"></td></tr>
            </form>
        </table>
        </div>
    </div>
</div>

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
require_once('./rodape.php');
?>

