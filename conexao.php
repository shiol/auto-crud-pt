<?php
$host = 'localhost';
$db   = 'teste3';
$user = 'root';
$pass = 'mysql';
$sgbd='mysql';      // pgsql, mysql
$table='clientes';
$script = 'scripts/my.sql';

// Conectar ao banco sys
$pdo0 = new PDO("$sgbd:host=$host;dbname=sys;", $user, $pass, $opt);

// Caso não exista o banco $db será criado
$ret = $pdo0->query('create database if not exists '.$db);

// Se for criado o banco o script $script será importado para o mesmo
if($ret){
    $pdo0->query('use '.$db);

    $sqlSource = file_get_contents($script);
    $pdo0->exec($sqlSource);
    $pdo0 = null;
}

// Adotar algumas opções para o PDO
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
];

// Conectar ao banco com PDO
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

// Incluir o funcoes.php
require_once('./funcoes.php');
