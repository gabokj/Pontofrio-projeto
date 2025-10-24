<?php 
$servidor = "localhost";
$usuarios = "root";
$senha = "";
$banco = "sistema_login";

$conexao = new mysqli($servidor,$usuarios,$senha,$banco);
if ($conexao->connect_error) {
    die("Erro de conexão: ". $conexao->connect_error);
}
