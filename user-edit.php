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
		<title>Meus dados</title>
<body>
    <div id="body">
    <?php include "topo.php"; ?>
        <?php
        if(!is_logado()) {
            echo msg_error("Faça o Login ");
            echo "<a href='user-login.php'>Login</a> | ";
        }else {
            if(!isset($_POST['usuario'])) {
                include "user-edit-form.php";
            } else {
               $usuario = $_POST['usuario'] ?? null;
               $nome = $_POST['nome'] ?? null;
               $tipo = $_POST['tipo'] ?? null;
               $senha1 = $_POST['senha1'] ?? null;
               $senha2 = $_POST['senha2'] ?? null;

               $q = "update usuarios set usuario = '$usuario', nome = '$nome'";
            
               if(empty($senha1) || is_null($senha1)) {
                   echo msg_aviso("Senha antiga foi mantida.");
               }else {
                   if ($senha1 === $senha2) {
                    $senha = gerarHash($senha1);
                       $q .= ", senha='$senha'";
                   }else {
                       echo msg_error("Senhas não conferem. A senha anterior será mantida.");
                   }
               }
               $q .= " where usuario = '" . $_SESSION['user'] . "'";

               if($banco->query($q)) {
                   echo msg_sucesso("Usuário alterado com sucesso!" . $senha);
                   logout();
                   echo msg_aviso("Por segurança efetue o <a href='user-login.php'>login </a> novamente!");
               }else {
                   echo msg_error("não foi possivel alterar os dados.");
               }
            }
  
        }

        ?>
        <?php echo voltar()?>
         </div>
        <?php require_once "rodape.php";?>
   
</body>
</html>
