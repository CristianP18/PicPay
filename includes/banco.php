<pre><?php

$banco = new mysqli('mysql.meusimulador.com', 'meusimulador3', '@Meusimulador@', 'meusimulador3');
if($banco->connect_errno){
    echo "<p>Encontrei um erro $banco->errno --> $banco->connect_error</p>";
    die();
}
$banco->query("SET NAMES 'UTF8'");
$banco->query("SET character_set_connection=utf8");
$banco->query("SET character_set_client=utf8");
$banco->query("SET character_set_results=utf8");


