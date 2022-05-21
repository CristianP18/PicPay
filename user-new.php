<?php

require_once "includes/banco.php";
require_once "includes/funcoes.php"; 
require_once "includes/login.php";
?>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="style.css"/>
        <title>Detalhes do Jogo</title>
<body>
    <div id="body">
    <?php include "topo.php"; ?>
        <?php
        if(!is_admin()) {
            echo   msg_error('Area restrita! Vocẽ não é administrador.');
        }else {
            if (!isset($_POST['usuario'])){
                require "user-new-form.php";
            }else {
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $tipo = $_POST['tipo'] ?? null;
            
                if ($senha1 === $senha2) {
                    if (empty($usuario) || empty($nome) || empty($senha1) || empty($senha2) || empty($tipo)) {
                        echo msg_aviso(" Todos os Campos São Obrigatórios");
                    }else {
                        $senha = gerarHash($senha1);                       
                        $q = "INSERT INTO usuarios (usuario, nome, senha, tipo) VALUES ('$usuario', '$nome', '$senha', '$tipo')";
                        if ($banco->query($q)) {
                            echo msg_sucesso("Usuário $nome cadastrado com sucesso!");
                        } else {
                            echo msg_error("Não foi possivel cadastrar o $usuario. Talvez o lohin ja esteja sendo usado.");
                        }
                    }
                }else {
                     echo msg_error("Senhas não conferem. Repita o procedimnto");
                     
                    }
                }     
        }
        echo voltar("Voltar");
        ?>
    </div>
</body>
</html>