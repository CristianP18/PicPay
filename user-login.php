<!DOCTYPE html>
<?php 
session_start();
require_once "includes/banco.php";
require_once "includes/funcoes.php"; 
require_once "includes/login.php";


?>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="style.css"/>
		<link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
		<title>Login de Usuário</title>
        <style>
            div#body {
                width:270px;
            }
            table {
                padding: 10px;
            }
            </style>
<body>
    <div id="body">


        <?php 
        $u = $_POST['usuario'] ?? null;
        $s = $_POST['senha'] ?? null;
        
        if (is_null($u) || is_null($s)) {
            require "user-login-from.php";
        }else {
            $q = "SELECT usuario, nome, senha, tipo from usuarios where usuario = '$u' limit 1";
            $busca = $banco->query($q);
            if(!$busca) {
                echo msg_error('Falha ao acessar o banco!');
                
            } else {
                if ($busca->num_rows > 0){
                    $reg = $busca->fetch_object();
                    $s = cripto($s);
                    if(testarHash($s, $reg->senha)) {
                        $_SESSION['user'] = $reg->usuario;
                        $_SESSION['nome'] = $reg->nome;
                        $_SESSION['tipo'] = $reg->tipo;
                        echo msg_sucesso('Logado com sucesso');
                        echo "Bem Vindo: " .  $_SESSION['nome'];
                        
                     }else {
                         
                            echo msg_error('Senha inválida');
                         
                        
                     }
            
            }else {
                    echo msg_error('Usuário não existe!');
                }
                
                }}
                echo "Bem Vindo:   <strong> " . $_SESSION['nome'] . "</strong> |";
                echo"<p class='pequeno'>";
                if(empty($_SESSION['user'])){
                    echo "<a href='user-login-form.php'>Entrar</a> |";
                }else {
                   
                    echo $_SESSION['tipo']. " | ";
                    echo "<a href='user-logout.php'>Sair</a> | ";
                    echo "<a href='user-edit-form.php'>Meu Dados</a> | ";
                    if (is_admin()) {
                        echo "<a href='user-new-form.php'>Novo usuário</a> | ";
                        
                    } 
                }
                echo"</p>";
        echo voltar2();
        ?>
    </div>
</body>
</html>