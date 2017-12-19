<?php
$host = '127.0.0.1';
/*
$db   = 'cadastro';
$user = 'postgres';
$pass = 'postgres';
$sgbd='pgsql';      // pgsql, mysql
$table='clientes';
*/
$db   = 'cadastro';
$user = 'root';
$pass = '';
$sgbd='mysql';      // pgsql, mysql
$table='clientes';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
];

try {
    $pdo = new PDO("$sgbd:host=$host;dbname=$db;", $user, $pass, $opt);

    // echo 'Conectado para o banco de dados<br />';

    // Fechar conexão com o banco de dados
    // $pdo = null;
}catch(PDOException $e){
    echo '<br><br><b>Mensagem</b>: '. $e->getMessage().'<br>';// Usar estas linhas no catch apenas em ambiente de testes/desenvolvimento
    echo '<b>Arquivo</b>: '.$e->getFile().'<br>';
    echo '<b>Linha</b>: '.$e->getLine().'<br>';
}

