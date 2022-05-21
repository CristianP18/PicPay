<?php

require_once "includes/funcoes.php";
require_once "includes/banco.php";
require_once "includes/login.php";
?>
<?php
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